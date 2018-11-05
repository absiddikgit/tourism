<?php

namespace App\Models\Admin\Package;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * The Package that belong to the model.
     */
    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
