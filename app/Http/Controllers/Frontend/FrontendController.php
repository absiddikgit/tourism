<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Admin\Place\Place;
use App\Models\Admin\Hotel\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Package\PackageType;

class FrontendController extends Controller
{
    public function index()
    {
        return view('welcome')
        ->with('top_3_packages', Package::where('status',1)->orderBy('created_at','desc')->take(3)->get())
        ->with('top_3_places', Place::orderBy('created_at','desc')->take(3)->get());
    }

    public function placeDetails($slug)
    {
        $place = Place::where('slug',$slug)->first();

        return view('frontend.place_details')
        ->with('place', $place);
    }

    public function places()
    {
        $places = Place::paginate(9);

        return view('frontend.places')
        ->with('places', $places);
    }

    public function hotelDetails($slug)
    {
        $hotel = Hotel::where('slug',$slug)->first();

        return view('frontend.hotel_details')
        ->with('hotel', $hotel);
    }

    public function packageDetails($slug)
    {
        $package = Package::where('status',1)->where('slug',$slug)->first();

        return view('frontend.package_details')
        ->with('package', $package);
    }

    public function packages()
    {
        $packages = Package::where('status',1)->paginate(9);
        return view('frontend.packages')
        ->with('packages', $packages);
    }

    public function typePackages($slug)
    {
        $type = PackageType::where('slug',$slug)->first();
        $packages = Package::where('status',1)->select('packages.*','package_type_costs.cost')
                                ->join('package_type_costs','package_type_costs.package_id','=','packages.id')
                                ->where('package_type_costs.type',$type->id)
                                ->paginate(9);

        return view('frontend.type_packages')
        ->with('packages', $packages)
        ->with('type', $type);
    }
}
