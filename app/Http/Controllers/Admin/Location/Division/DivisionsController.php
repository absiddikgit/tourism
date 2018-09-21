<?php

namespace App\Http\Controllers\Admin\Location\Division;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Location\Division;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.location.division.index')
        ->with('divisions', Division::orderBy('name')->get());
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
            'division' => 'required|min:2|unique:divisions,name',
        ]);

        $division = new Division;
        $division->name = $request->division;
        $division->slug = str_slug($request->name);
        if ($division->save()) {
            Session::flash('success','Division created successfully');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.location.division.edit')
        ->with('division', Division::find($id));
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
            'division' => 'required|min:2|unique:divisions,name,'.$id,
        ]);

        $division = Division::find($id);
        $division->name = $request->division;
        $division->slug = str_slug($request->name);
        if ($division->save()) {
            Session::flash('success','Division updated successfully');
        }
        return redirect()->route('divisions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division = Division::find($id);

        if ($division->delete()) {
            Session::flash('success','Division deleted successfully');
        }
        return redirect()->route('divisions.index');
    }
}
