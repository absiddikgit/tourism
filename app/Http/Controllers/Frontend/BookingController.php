<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;

class BookingController extends Controller
{
    public function packageBooking($package_slug)
    {
        $package = Package::where('slug',$package_slug)->first();
        return view('frontend.booking.booking_form')
                ->with('package', $package);
    }
}
