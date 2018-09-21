<?php

namespace App\Models\Admin\Location;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    /**
     * Get the district for the model.
     */
    public function district()
    {
        return $this->hasMany(District::class);
    }
}
