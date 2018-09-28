<?php

namespace App\Http\Controllers\Admin\Package;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Package\PackageType;

class PackageTypesController extends Controller
{
    public function index()
    {
        return view('admin.package_type.index')
        ->with('package_types', PackageType::orderBy('type')->get());
    }

    public function create()
    {
        return view('admin.package_type.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => 'required|min:2|unique:package_types,type',
        ]);

        $package_type = new PackageType;
        $package_type->type = $request->type;
        $package_type->slug = str_slug($request->type);
        if ($package_type->save()) {
            Session::flash('success','Package Type created successfully');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.package_type.edit')
        ->with('package_type', PackageType::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'type' => 'required|min:2|unique:package_types,type,'.$id,
        ]);

        $package_type = PackageType::find($id);
        $package_type->type = $request->type;
        $package_type->slug = str_slug($request->type);
        if ($package_type->save()) {
            Session::flash('success','Package Type updated successfully');
        }
        return redirect()->route('package-types.index');
    }

    public function destroy($id)
    {
        $package_type = PackageType::find($id);

        if ($package_type->delete()) {
            Session::flash('success','Package Type deleted successfully');
        }
        return redirect()->route('package-types.index');
    }
}
