<?php

namespace App\Http\Controllers\Admin\Location\District;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Location\District;
use App\Models\Admin\Location\Division;

class DistrictsController extends Controller
{
    public function index()
    {
        return view('admin.location.district.index')
        ->with('districts', District::orderBy('name')->get());
    }

    public function create()
    {
        return view('admin.location.district.create')
        ->with('divisions', Division::pluck('name','id')->all());
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'division' => 'required',
            'district' => 'required|min:2|unique:districts,name',
        ]);

        $district = new District;
        $district->name = $request->district;
        $district->slug = str_slug($request->name);
        $district->division_id = $request->division;

        if ($district->save()) {
            Session::flash('success','District created successfully');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.location.district.edit')
        ->with('divisions', Division::pluck('name','id')->all())
        ->with('district', District::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'district' => 'required|min:2|unique:districts,name,'.$id,
        ]);

        $district = District::find($id);
        $district->name = $request->district;
        $district->slug = str_slug($request->name);
        if ($district->save()) {
            Session::flash('success','District updated successfully');
        }
        return redirect()->route('districts.index');
    }

    public function destroy($id)
    {
        $district = District::find($id);

        if ($district->delete()) {
            Session::flash('success','District deleted successfully');
        }
        return redirect()->route('districts.index');
    }

    public function getDistrict(Request $request)
    {
        $division_id = $request->id;
        return District::where('division_id', $division_id)->get()->toArray();
    }
}
