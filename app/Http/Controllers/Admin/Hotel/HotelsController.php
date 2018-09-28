<?php

namespace App\Http\Controllers\Admin\Hotel;

use Image;
use Session;
use Illuminate\Http\Request;
use App\Models\Admin\Hotel\Hotel;
use App\Http\Controllers\Controller;
use App\Models\Admin\Hotel\HotelImage;
use App\Models\Admin\Location\District;
use App\Models\Admin\Location\Division;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hotel.index')
        ->with('hotels', Hotel::orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotel.create')
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
            'name' => 'required|min:2',
            'division' => 'required',
            'district' => 'required',
            'description' => 'required',
            'location' => 'required',
            // 'image' => 'required',
        ]);

        $hotel = [
            'name'       => $request->name,
            'slug'        => str_slug($request->name.' '.time()),
            'division_id' => $request->division,
            'district_id' => $request->district,
            'description' => $request->description,
            'location'    => $request->location,
        ];

        $h = Hotel::create($hotel);

        // image upload & database store
        $h_images = $this->imageUpload($request->image,$h->id);


        if (HotelImage::insert($h_images)) {
            Session::flash('success', 'Hotel created successfully');
        }
        return redirect()->back();
    }

    public function imageUpload($hotel_images,$hotel_id)
    {
        if($hotel_images) {
            $i = 0;
            foreach ($hotel_images as $image) {
                $new_name = rand(1,99).time() . '.' .$image->getClientOriginalExtension();

                if (!file_exists(public_path('images/hotel/images/thumbnail'))) {
                    mkdir(public_path('images/hotel/images/thumbnail'), 0777, true);
                }

                //Upload File
                $image->move('public/images/hotel/images', $new_name);
                copy('public/images/hotel/images/'.$new_name, 'public/images/hotel/images/thumbnail/'.$new_name);


                //Resize image here
                $thumbnailpath = public_path('images/hotel/images/thumbnail/'.$new_name);
                // $img = Image::make($thumbnailpath)->resize(450, 600, function($constraint) {
                //     $constraint->aspectRatio();
                // });
                // $img->save($thumbnailpath);
                $img = Image::make($thumbnailpath)->resize(600, 300)->save($thumbnailpath);

                $h_images[$i]['hotel_id'] = $hotel_id;
                $h_images[$i]['image'] = $new_name;
                $i++;
            }
        }

        return $h_images;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.hotel.show')
        ->with('hotel', Hotel::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.hotel.edit')
        ->with('hotel', Hotel::find($id));
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
            'name' => 'required|min:2',
            'description' => 'required',
        ]);

        $hotel = [
            'name'       => $request->name,
            'slug'        => str_slug($request->name.' '.time()),
            'description' => $request->description,
        ];

        $h = Hotel::find($id);

        if ($h->update($hotel)) {
            Session::flash('success', 'Hotel details updated successfully');
        }
        return redirect()->back();
    }

    public function edit_location($hotel_id)
    {
        return view('admin.hotel.edit_location')
        ->with('hotel', Hotel::find($hotel_id))
        ->with('divisions', Division::pluck('name','id')->all());
    }

    public function update_location(Request $request, $hotel_id)
    {
        if ($request->division) {
            $this->validate($request,[
                'division' => 'required',
                'district' => 'required',
                'location' => 'required',
            ]);
            $hotel = [
                'division_id' => $request->division,
                'district_id' => $request->district,
                'location'    => $request->location,
            ];
        }else {
            $this->validate($request,[
                'location' => 'required',
            ]);
            $hotel = [
                'location'    => $request->location,
            ];
        }

        $h = Hotel::find($hotel_id);

        if ($h->update($hotel)) {
            Session::flash('success', 'Hotel location updated successfully');
        }
        return redirect()->back();
    }

    public function edit_image($hotel_id)
    {
        return view('admin.hotel.edit_img')
        ->with('hotel', Hotel::find($hotel_id))
        ->with('divisions', Division::pluck('name','id')->all());
    }

    public function update_image(Request $request, $hotel_id)
    {
        // image upload & database store
        $h_images = $this->imageUpload($request->image,$hotel_id);


        if (HotelImage::insert($h_images)) {
            Session::flash('success', 'New hotel image added successfully');
        }
        return redirect()->back();
    }

    public function destroy_image(Request $request, $image_id)
    {
        $image = HotelImage::find($image_id);
        if ($image->delete()) {
            Session::flash('success', 'Hotel image deleted successfully');
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
        $hotel = Hotel::find($id);
        foreach ($hotel->hotelImages as $hotel_image) {
            unlink('public/images/hotel/images/'.$hotel_image->getOriginal('image'));
            unlink('public/images/hotel/images/thumbnail/'.$hotel_image->getOriginal('image'));
        }

        if ($hotel->delete()) {
            Session::flash('success', 'Successfully deleted this hotel');
        }
        return redirect()->back();
    }
}
