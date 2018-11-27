<?php

namespace App\Http\Controllers\Customer\Booking;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking\Booking;

class PackageDetailsController extends Controller
{
    public function show($payment_id)
    {
        $booking_details =  Booking::where('payment_id', $payment_id)->first();
        return view('frontend.customer.booking_package_view', compact('booking_details'));
    }

    public function pdf($payment_id)
    {
        $booking_details =  Booking::where('payment_id', $payment_id)->first();

        $name = 'approve_list_' . time();
        $pdf = PDF::loadView('frontend.customer.pdf', ['booking_details'=>$booking_details])->setPaper('a4', 'portrait');
        return $pdf->stream($name.'.pdf');
    }
}
