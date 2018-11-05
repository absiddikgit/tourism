<?php

namespace App\Http\Controllers\Admin\Package;

use Session;
use Illuminate\Http\Request;
use App\Models\Admin\Package\Type;
use App\Http\Controllers\Controller;

class PackageTypesController extends Controller
{
    public function index()
    {
        return view('admin.package_type.index')
        ->with('package_types', Type::orderBy('type')->get());
    }

    public function create()
    {
        return view('admin.package_type.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'type' => 'required|min:2|unique:types,type',
        ]);

        $type = new Type;
        $type->type = $request->type;
        $type->slug = str_slug($request->type);
        if ($type->save()) {
            Session::flash('success','Package Type created successfully');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.package_type.edit')
        ->with('package_type', Type::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'type' => 'required|min:2|unique:types,type,'.$id,
        ]);

        $type = Type::find($id);
        $type->type = $request->type;
        $type->slug = str_slug($request->type);
        if ($type->save()) {
            Session::flash('success','Package Type updated successfully');
        }
        return redirect()->route('package-types.index');
    }

    public function destroy($id)
    {
        $type = Type::find($id);

        if ($type->delete()) {
            Session::flash('success','Package Type deleted successfully');
        }
        return redirect()->route('package-types.index');
    }
}
