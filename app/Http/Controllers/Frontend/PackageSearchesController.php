<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Admin\Place\Place;
use App\Models\Admin\Hotel\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\Package;
use App\Models\Admin\Package\PackageType;

class PackageSearchesController extends Controller
{
    public function searchPackages(Request $request)
    {
        $packages = [];

        if ($request->type == null && $request->from == null && $request->to == null) {
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

        // return Package::whereBetween('departs_date', array($request->from,$request->to))->get();

        if ($request->type != null) {
            $type = PackageType::where('slug',$request->type)->first();
            if ($type) {
                $packages = Package::where('status',1)->select('packages.*','package_type_costs.cost')
                                        ->join('package_type_costs','package_type_costs.package_id','=','packages.id')
                                        ->where('package_type_costs.type',$type->id)
                                        ->whereBetween('packages.departs_date', array($request->from,$request->to))
                                        ->paginate(9);
            }
        }else {
            $packages = Package::whereBetween('departs_date', array($request->from,$request->to))->paginate(9);
        }
        return view('frontend.search_packages')
        ->with('packages', $packages);
    }
}
