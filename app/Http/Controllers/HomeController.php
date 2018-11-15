<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Place\Place;
use App\Models\Booking\Booking;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')
                ->with('total_package', Package::count())
                ->with('total_place', Place::count())
                ->with('total_booking', Booking::count())
                ->with('total_customer', Customer::count())
                ->with('running_packages', Package::where('status',1)->get());
    }
}
