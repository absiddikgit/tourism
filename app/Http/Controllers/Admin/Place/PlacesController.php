<?php

namespace App\Http\Controllers\Admin\Place;

use Image;
use Session;
use Illuminate\Http\Request;
use App\Models\Admin\Place\Place;
use App\Http\Controllers\Controller;
use App\Models\Admin\Place\PlaceImage;
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
        return view('admin.place.index')
        ->with('places', Place::orderBy('title')->get());
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
            // 'image' => 'required',
        ]);

        $place = [
            'title'       => $request->title,
            'slug'        => str_slug($request->title.' '.time()),
            'division_id' => $request->division,
            'district_id' => $request->district,
            'description' => $request->description,
            'location'    => $request->location,
        ];

        $p = Place::create($place);

        // image upload & database store
        $p_images = $this->imageUpload($request->image,$p->id);


        if (PlaceImage::insert($p_images)) {
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
                $img = Image::make($thumbnailpath)->resize(600, 500)->save($thumbnailpath);

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
        return view('admin.place.show')
        ->with('p', Place::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.place.edit')
        ->with('p', Place::find($id));
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
            'title' => 'required|min:2',
            'description' => 'required',
        ]);

        $place = [
            'title'       => $request->title,
            'slug'        => str_slug($request->title.' '.time()),
            'description' => $request->description,
        ];

        $p = Place::find($id);

        if ($p->update($place)) {
            Session::flash('success', 'Place details updated successfully');
        }
        return redirect()->back();
    }

    public function edit_location($place_id)
    {
        return view('admin.place.edit_location')
        ->with('p', Place::find($place_id))
        ->with('divisions', Division::pluck('name','id')->all());
    }

    public function update_location(Request $request, $place_id)
    {
        if ($request->division) {
            $this->validate($request,[
                'division' => 'required',
                'district' => 'required',
                'location' => 'required',
            ]);
            $place = [
                'division_id' => $request->division,
                'district_id' => $request->district,
                'location'    => $request->location,
            ];
        }else {
            $this->validate($request,[
                'location' => 'required',
            ]);
            $place = [
                'location'    => $request->location,
            ];
        }

        $p = Place::find($place_id);

        if ($p->update($place)) {
            Session::flash('success', 'Place location updated successfully');
        }
        return redirect()->back();
    }

    public function edit_image($place_id)
    {
        return view('admin.place.edit_img')
        ->with('p', Place::find($place_id))
        ->with('divisions', Division::pluck('name','id')->all());
    }

    public function update_image(Request $request, $place_id)
    {
        // image upload & database store
        $p_images = $this->imageUpload($request->image,$place_id);


        if (PlaceImage::insert($p_images)) {
            Session::flash('success', 'New place image added successfully');
        }
        return redirect()->back();
    }

    public function destroy_image(Request $request, $image_id)
    {
        $image = PlaceImage::find($image_id);
        if ($image->delete()) {
            Session::flash('success', 'Place image deleted successfully');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        foreach ($place->placeImages as $place_image) {
            unlink('public/images/place/images/'.$place_image->getOriginal('image'));
            unlink('public/images/place/images/thumbnail/'.$place_image->getOriginal('image'));
        }

        if ($place->delete()) {
            Session::flash('success', 'Successfully deleted this place');
        }
        return redirect()->back();
    }

    public function getPlace(Request $r)
    {
        $division_id = $r->division_id;
        $district_id = $r->district_id;

        return $places = Place::where('division_id',$division_id)->where('district_id',$district_id)->with('placeImages')->get()->toArray();

    }
}
