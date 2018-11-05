<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Admin\Place\Place;
use App\Models\Admin\Hotel\Hotel;
use App\Models\Admin\Package\Type;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Location\Division;
use App\Models\Admin\Location\District;

class PackageSearchesController extends Controller
{
    public function searchPackages(Request $request)
    {
        $packages = [];
        $whereClause = [];

        if ($request->type == null && $request->from == null && $request->to == null && $request->division == null && $request->district == null) {
            return redirect()->back();
        }

        if ($request->from) {
            $request['from'] = date("Y-m-d", strtotime($request->from));
        }else {
            $request['from'] = date("Y.m.d");
        }

        if ($request->to) {
            $request['to'] = date("Y-m-d", strtotime($request->to));
        }else {
            $request['to'] = '9999-12-31';
        }

        if ($request->division) {
            $division = Division::where('slug',$request->division)->first();
            $whereClause['packages.division_id'] = $division->id;
        }

        if ($request->district) {
            $district = District::where('slug',$request->district)->first();
            $whereClause['packages.district_id'] = $district->id;
        }

        // return Package::whereBetween('departs_date', array($request->from,$request->to))->get();

        if ($request->type != null) {
            $type = Type::where('slug',$request->type)->first();
            if ($type) {
                $packages = Package::where('status',1)->select('packages.*','package_type.package_id')
                                        ->join('package_type','package_type.package_id','=','packages.id')
                                        ->where('package_type.type_id',$type->id)
                                        ->where($whereClause)
                                        ->whereBetween('packages.departs_date', array($request->from,$request->to))
                                        ->paginate(9);
            }
        }else {
            $packages = Package::whereBetween('departs_date', array($request->from,$request->to))->where($whereClause)->paginate(9);
        }
        return view('frontend.search_packages')
        ->with('packages', $packages);
    }

    public function getDistrictsInFront(Request $request)
    {
        $division = Division::where('slug',$request->slug)->first();
        // return District::where('division_id', $division->id)->get()->toArray();
        //

        return response()->json(District::where('division_id', $division->id)->get());

    }
}
