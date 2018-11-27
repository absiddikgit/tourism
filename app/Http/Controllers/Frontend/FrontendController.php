<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Admin\Place\Place;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Package\Type;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Location\Division;

class FrontendController extends Controller
{
    public function index()
    {
        $quotes = [
            '“Traveling – it leaves you speechless, then turns you into a storyteller.” ',
            'Better to see something once than hear about it a thousand times ',
            'Dare to live the life you’ve always wanted  ',
            '“Traveling 4 – it leaves you speechless, then turns you into a storyteller.” ',
            '“Traveling 5 – it leaves you speechless, then turns you into a storyteller.” ',
        ];
        return view('welcome')
        // ->with('package_types', Type::orderBy('type')->get())
        // ->with('divisions', Division::orderBy('name')->get())
        ->with('quotes', $quotes)
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
        $package = Package::where('slug',$slug)->first();

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
        $packages = [];
        $type = Type::where('slug',$slug)->first();
        if ($type) {
            $packages = Package::where('status',1)->select('packages.*')
                                    ->join('package_type','package_type.package_id','=','packages.id')
                                    ->where('package_type.type_id',$type->id)
                                    ->paginate(9);
        }


        return view('frontend.type_packages')
        ->with('packages', $packages)
        ->with('type', $type);
    }
}
