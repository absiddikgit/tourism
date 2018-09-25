<?php

namespace App\Models\Admin\Place;

use Illuminate\Database\Eloquent\Model;

class PlaceImage extends Model
{
    public function getImageAttribute($value='')
    {
        return asset('images/place/images/thumbnail/'.$value);
    }
}
