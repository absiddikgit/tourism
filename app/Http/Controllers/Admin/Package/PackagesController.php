<?php

namespace App\Http\Controllers\Admin\Package;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Location\Division;
use App\Models\Admin\Package\PackageType;
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
                ->with('package_types', PackageType::orderBy('type')->pluck('type','id')->all())
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
            'departs' => 'required',
            'return' => 'required',
            'deadline' => 'required',

            // package type cost
            'package_types' => 'required',
            'package_costs' => 'required',

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

        $package_type_cost = $this->packageTypeCost($input['package_types'], $input['package_costs'], $package->id);

        if (PackageTypeCost::insert($package_type_cost)) {
            Session::flash('success','Package created successfully');
        }

        return redirect()->back();
    }

    public function packageTypeCost($type,$cost,$package_id)
    {
        $data = [];

        for ($i=0; $i < count($type) ; $i++) {
            $data[$i]['package_id'] = $package_id;
            $data[$i]['type'] = $type[$i];
            $data[$i]['cost'] = $cost[$i];
        }

        return $data;
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
        $package_types = PackageType::select('package_types.id','package_types.type','package_type_costs.cost')->leftJoin('package_type_costs', function($join)use($id){
                                                $join->on('package_type_costs.type', '=', 'package_types.id')
                                                 ->where('package_type_costs.package_id', '=', $id);
                                            })
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
            'package_types' => 'required',
            'package_costs' => 'required',
        ]);

        $package = Package::find($id);

        $input = $request->all();

        $input['slug'] = str_slug($request->title);
        $input['departs_date'] = date('Y-m-d',strtotime($request->departs));
        $input['return_date'] = date('Y-m-d',strtotime($request->return));
        $input['booking_deadline'] = date('Y-m-d',strtotime($request->deadline));

        $package->update($input);

        if (PackageTypeCost::where('package_id',$id)->count()) {
            PackageTypeCost::where('package_id',$id)->delete();
        }

        $package_type_cost = $this->packageTypeCost($input['package_types'], $input['package_costs'], $package->id);

        if (PackageTypeCost::insert($package_type_cost)) {
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
        //
    }
}
