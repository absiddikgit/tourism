<?php

namespace App\Models\Admin\Location;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /**
     * Get the division that owns the model.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
