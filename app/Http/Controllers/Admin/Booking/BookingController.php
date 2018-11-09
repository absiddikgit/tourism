<?php

namespace App\Http\Controllers\Admin\Booking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking\Booking;
use App\Models\Admin\Package\Package;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.booking.package_list')
                ->with('packages', Package::where('status', 1)->latest()->get());
    }

    public function list($package_id)
    {
        return view('admin.booking.booking_list')
                ->with('package', Package::select('id')->find($package_id))
                ->with('booking_details', Booking::where('package_id', $package_id)->get());
    }
}
