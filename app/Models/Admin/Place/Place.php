<?php

namespace App\Models\Admin\Place;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['title','slug','division_id','district_id','description','location'];

    /**
     * Get the Division that owns the model.
     */
    public function division()
    {
        return $this->belongsTo('App\Models\Admin\Location\Division');
    }

    /**
     * Get the District that owns the model.
     */
    public function district()
    {
        return $this->belongsTo('App\Models\Admin\Location\District');
    }

    /**
     * Get the PlaceImage for the model.
     */
    public function placeImages()
    {
        return $this->hasMany(PlaceImage::class);
    }
}
