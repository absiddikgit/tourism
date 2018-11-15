<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Booking\Booking;
use App\Models\Customer\Customer;
use App\Models\Admin\Package\Type;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use Srmklive\PayPal\Services\AdaptivePayments;

class BookingController extends Controller
{
    public function packageBooking($package_slug)
    {
        $package = Package::where('slug',$package_slug)->first();
        return view('frontend.booking.booking_form')
        ->with('package', $package);
    }

    public function bookingConfirm(Request $request)
    {
        $package = Package::where('slug',$request->package)->first();
        $type = Type::where('slug',$request->type)->first();
        $user = Customer::find(Auth::guard('customer')->user()->id);

        if (!$user->customerInfo) {
            Session::flash('success','Please update you details');
            return redirect()->route('customer.profile');
        }

        $qty = '';
        if ($request->num_of_travelers) {
            $qty = $request->num_of_travelers;
        }else {
            $qty = $this->qty($request->type);
        }

        if ($package->availableSeat() < ($qty + $request->num_of_child)) {
            Session::flash('info','Apologise! Available seat is '.$package->availableSeat());
            return redirect()->back();
        }

        $total_cost = 0;

        if ($request->num_of_child) {
            $total_cost = ($package->cost*$qty) + ($package->cost/2*$request->num_of_child);
        }else {
            $total_cost = $package->cost*$qty;
        }

        return view('frontend.booking.booking_confirm_form')
        ->withUser(Customer::find(Auth::guard('customer')->user()->id))
        ->with('c_type', $type)
        ->with('qty', $qty)
        ->with('num_of_child', $request->num_of_child)
        ->with('package', $package)
        ->with('total_cost', $total_cost);
    }

    public function qty($type)
    {
        if ($type == "couple") {
            return 2;
        }elseif ($type == "single") {
            return 1;
        }
    }

    public function payWithPaypal(Request $r)
    {
        // My data
        $qty = '';
        $package = Package::find($r->package);

        if ($r->num_of_travelers) {
            $qty = $r->num_of_travelers;
        }else {
            $qty = $this->qty($r->type);
        }

        $total_cost = 0;

        if ($r->num_of_child) {
            $total_cost = ($package->cost*$qty) + ($package->cost/2*$r->num_of_child);
        }else {
            $total_cost = $package->cost*$qty;
        }

        $details = [
            'package' => $r->package,
            'contact_number' => $r->contact_number,
            'type' => $r->type,
            'qty' => $qty,
            'num_of_child' => $r->num_of_child,
            'total_cost' => $total_cost,
        ];

        // Paypal

        $provider = new AdaptivePayments;
        $data = [];
        $data = [
            'receivers'  => [
                [
                    'email' => 'bdtravels123@gmail.com',
                    'amount' => $total_cost,
                    'primary' => true,
                ],
                [
                    'email' => 'janedoe@example.com',
                    'amount' => $total_cost,
                    'primary' => false
                ]
            ]
        ];

        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "this is test";
        $data['payer'] = "EACHRECEIVER";
        $data['return_url'] = route('frontend.booking.payment.store',$details);
        $data['cancel_url'] = route('frontend.package.booking',$package->slug);
        $data['total'] = $total_cost;
        $response = $provider->createPayRequest($data);

        $details['payKey'] = $response['payKey'];

        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);
        return redirect($redirect_url);
    }

    public function paymentComplete(Request $request)
    {
        $type = Type::where('slug',$request->type)->first();

        $booking = new Booking();

        $booking->customer_id = Auth::guard('customer')->user()->id;

        $booking->package_id = $request->package;

        $booking->type_id = $type->id;

        $booking->num_of_travelers = $request->qty;

        $booking->num_of_child = $request->num_of_child;

        $booking->contact_number = $request->contact_number;

        $booking->total_cost = $request->total_cost;

        if ($booking->save()) {
            Session::flash('success','Booking has been completed successfully');
        }

        return redirect()->route('customer.dashboard');

    }
}
