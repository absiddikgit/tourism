<?php

namespace App\Models\Admin\Package;

use Illuminate\Database\Eloquent\Model;

class PackageTypeCost extends Model
{
    /**
     * Get the PackageType that owns the model.
     */
    public function packageType()
    {
        return $this->belongsTo(PackageType::class,'type');
    }
}
