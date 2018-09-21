<?php

namespace App\Http\Controllers\Admin\Place;

use Session;
use App\Models\Admin\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Location\District;
use App\Models\Admin\Location\Division;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.place.create')
        ->with('divisions', Division::pluck('name','id')->all());
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
            'title' => 'required|min:2',
            'division' => 'required',
            'district' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required',
        ]);

        $place = new Place;
        $place->title = $request->title;
        $place->slug = str_slug($request->title.' '.time());
        $place->division_id = $request->division;
        $place->district_id = $request->district;
        $place->description = $request->description;
        $place->location = $request->location;

        if ($place->save()) {
            Session::flash('success', 'Place created successfully');
        }
        return redirect()->back();
    }

    public function imageUpload($place_images,$place_id)
    {
        if($place_images) {
            $i = 0;
            foreach ($place_images as $image) {
                $new_name = rand(1,99).time() . '.' .$image->getClientOriginalExtension();

                if (!file_exists(public_path('images/place/images/thumbnail'))) {
                    mkdir(public_path('images/place/images/thumbnail'), 0777, true);
                }

                //Upload File
                $image->move('public/images/place/images', $new_name);
                copy('public/images/place/images/'.$new_name, 'public/images/place/images/thumbnail/'.$new_name);


                //Resize image here
                $thumbnailpath = public_path('images/place/images/thumbnail/'.$new_name);
                // $img = Image::make($thumbnailpath)->resize(450, 600, function($constraint) {
                //     $constraint->aspectRatio();
                // });
                // $img->save($thumbnailpath);
                $img = Image::make($thumbnailpath)->resize(450, 600)->save($thumbnailpath);

                $p_images[$i]['place_id'] = $place_id;
                $p_images[$i]['image'] = $new_name;
                $i++;
            }
        }

        return $p_images;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
