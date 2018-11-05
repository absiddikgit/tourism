<?php

namespace App\Http\Controllers\Admin\Package;

use Session;
use Illuminate\Http\Request;
use App\Models\Admin\Place\Place;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Package\Type;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Location\Division;
use App\Models\Admin\Package\PackageTypeCost;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.package.index')
                ->with('packages', Package::orderBy('departs_date','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create')
                ->with('status', Package::STATUS)
                ->with('package_types', Type::orderBy('type')->pluck('type','id')->all())
                ->with('divisions', Division::orderBy('name')->pluck('name','id')->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            // package
            'division' => 'required',
            'district' => 'required',

            // package place
            'places' => 'required',

            // package hotel
            'hotels' => 'required',

            // package
            'departs'  => 'required',
            'return'   => 'required',
            'deadline' => 'required',
            'cost'     => 'required|min:2',

            // package type cost
            'types' => 'required',
            // package
            'status' => 'required',
        ]);

        $input = $request->all();

        $input['slug'] = str_slug($request->title.' '.time());
        $input['division_id'] = $request->division;
        $input['district_id'] = $request->district;
        $input['departs_date'] = date('Y-m-d',strtotime($request->departs));
        $input['return_date'] = date('Y-m-d',strtotime($request->return));
        $input['booking_deadline'] = date('Y-m-d',strtotime($request->deadline));

        $package = Package::create($input);
        $package->places()->sync($input['places']);
        $package->hotels()->sync($input['hotels']);
        $package->types()->sync($input['types']);

        if ($package) {
            Session::flash('success','Package created successfully');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.package.show')
                ->with('package', Package::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package_types = Type::select('types.*', 'package_type.package_id')
                                ->leftJoin('package_type', function($join)use($id){
                                    $join->on('package_type.type_id', '=', 'types.id')
                                            ->where('package_type.package_id', '=', $id);
                                })
                                ->orderBy('type')
                                ->get();
        return view('admin.package.edit.details')
                ->with('package_types', $package_types)
                ->with('package', Package::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            // package
            'departs' => 'required',
            'return' => 'required',
            'deadline' => 'required',

            // package type cost
            'types' => 'required',
            'cost' => 'required',
        ]);

        $package = Package::find($id);

        $input = $request->all();

        $input['slug'] = str_slug($request->title.' '.time());
        $input['departs_date'] = date('Y-m-d',strtotime($request->departs));
        $input['return_date'] = date('Y-m-d',strtotime($request->return));
        $input['booking_deadline'] = date('Y-m-d',strtotime($request->deadline));

        $package->update($input);


        $package->types()->sync($input['types']);

        if ($package) {
            Session::flash('success','Package details updated successfully');
        }

        return redirect()->route('packages.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);

        if ($package->delete()) {
            Session::flash('success','Package deleted successfully');
        }

        return redirect()->route('packages.index');
    }

    public function editPlaceHotel($id)
    {
        $package = Package::select('division_id','district_id')->find($id);

        $places = Place::select('places.*','package_place.package_id as package_id')
                        ->where('division_id',$package->division_id)
                        ->where('district_id', $package->district_id)
                        ->leftJoin('package_place',function ($join) use($id){
                            $join->on('package_place.place_id','=','places.id');
                            $join->where('package_place.package_id',$id);
                        })->get();

        $hotels = Hotel::select('hotels.*','hotel_package.package_id as package_id')
                        ->where('division_id',$package->division_id)
                        ->where('district_id', $package->district_id)
                        ->leftJoin('hotel_package',function ($join) use($id){
                            $join->on('hotel_package.hotel_id','=','hotels.id');
                            $join->where('hotel_package.package_id',$id);
                        })->get();

        return view('admin.package.edit.place_hotel')
        ->with('package_id', $id)
        ->with('places', $places)
        ->with('hotels', $hotels);
    }

    public function updatePlaceHotel(Request $r,$id)
    {
        $this->validate($r,[
            // package place
            'places' => 'required',

            // package hotel
            'hotels' => 'required',
        ]);

        $input =  $r->all();
        $package = Package::find($id);
        $package->places()->sync($input['places']);
        $package->hotels()->sync($input['hotels']);

        return redirect()->route('packages.show',$id);
    }

    public function isActive($id)
    {
        $package = Package::find($id);
        if ($package->getOriginal('status')) {
            $package->status = 0;
            Session::flash('success','Package deactive successfully');
        }else {
            $package->status = 1;
            Session::flash('success','Package active successfully');
        }
        $package->save();

        return redirect()->route('packages.index');
    }
}
