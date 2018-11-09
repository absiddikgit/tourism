<?php

namespace App\Models\Booking;

use App\Models\Admin\Package\Type;
use App\Models\Admin\Package\Package;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * Get the Package that owns the model.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the Type that owns the model.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
