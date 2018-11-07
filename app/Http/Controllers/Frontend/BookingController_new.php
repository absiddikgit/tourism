<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Models\Booking\Booking;
use App\Models\Customer\Customer;
use App\Models\Admin\Package\Type;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use Srmklive\PayPal\Services\ExpressCheckout;

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

        $qty = '';
        if ($request->num_of_travelers) {
            $qty = $request->num_of_travelers;
        }else {
            $qty = $this->qty($request->type);
        }

        $total_cost = $package->cost*$qty;

        return view('frontend.booking.booking_confirm_form')
        ->withUser(Customer::find(Auth::guard('customer')->user()->id))
        ->with('c_type', $type)
        ->with('qty', $qty)
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
        $qty = '';
        if ($r->num_of_travelers) {
            $qty = $r->num_of_travelers;
        }else {
            $qty = $this->qty($r->type);
        }

        $provider = new ExpressCheckout;

        $package = Package::find($r->package);

        $details = [
            'package' => $r->package,
            'contact_number' => $r->contact_number,
            'type' => $r->type,
            'qty' => $qty,
        ];

        $data = [];
        $data['items'] = [
            [
                'name' => $package->title,
                'price' => $package->cost,
                'qty' => $qty,
            ]
        ];

        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "this is test";
        $data['return_url'] = route('frontend.booking.payment.store',$details);
        $data['cancel_url'] = route('frontend.package.booking',$package->slug);

        $data['total'] = $package->cost*$qty;

        $response = $provider->setExpressCheckout($data);

        // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }

    public function paymentComplete(Request $request)
    {
        $provider = new ExpressCheckout;
        return $response = $provider->getExpressCheckoutDetails($request->token);

        $booking = new Booking();

        $booking->customer_id = Auth::guard('customer')->user()->id;

        $booking->package_id = $request->package;

        $booking->type_id = $request->type;

        $booking->num_of_travelers = $request->qty;

        $booking->contact_number = $request->contact_number;

        $booking->invoice_id = $response->INVNUM;

        $booking->total_cost = $response->AMT;

        $booking->payer_id = $request->PayerID;

        $booking->token = $request->token;

        if ($booking->save()) {
            Session::flash('success','<b>Success! </b>Booking is completed');
        }

        return redirect()->route('customer.dashboard');

    }
}
