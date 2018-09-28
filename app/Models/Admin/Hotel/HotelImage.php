<?php

namespace App\Models\Admin\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
    public function getImageAttribute($value='')
    {
        return asset('images/hotel/images/thumbnail/'.$value);
    }
}
