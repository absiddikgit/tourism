<?php

namespace App\Models\Admin\Package;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    const STATUS = [''=>'Choose','1'=>'Active','0'=>'Deactive'];
}
