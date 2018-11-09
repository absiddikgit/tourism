<?php

namespace App\Models\Admin\Package;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Package\PackageType;
use App\Models\Booking\Booking;

class Package extends Model
{
    const STATUS = [''=>'Choose','1'=>'Active','0'=>'Deactive'];

    protected $fillable = ['title','slug','division_id','district_id','description','cost','departs_date','return_date','booking_deadline','status'];

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
     * The Type that belong to the model.
     */
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    /**
     * The Place that belong to the model.
     */
    public function places()
    {
        return $this->belongsToMany('App\Models\Admin\Place\Place');
    }

    /**
     * The Hotel that belong to the model.
     */
    public function hotels()
    {
        return $this->belongsToMany('App\Models\Admin\Hotel\Hotel');
    }

    public function getStatusAttribute($value='')
    {
        return self::STATUS[$value];
    }

    public function getDepartsDateAttribute($value='')
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getReturnDateAttribute($value='')
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getBookingDeadlineAttribute($value='')
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getInterval()
    {
        $depart = date_create($this->getOriginal('departs_date'));
        $return = date_create($this->getOriginal('return_date'));
        $interval = date_diff($depart,$return);
        $days = $interval->format('%a');
        return $days+1;
    }

    /**
     * Get the Booking for the model.
     */
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
