<?php

namespace App\Models\Admin\Hotel;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['name','slug','division_id','district_id','description','location'];

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
     * Get the HotelImage for the model.
     */
    public function hotelImages()
    {
        return $this->hasMany(HotelImage::class);
    }

    /**
     * The Package that belong to the model.
     */
    public function packages()
    {
        return $this->belongsToMany('App\Models\Admin\Package\Package');
    }
}
