<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name','email','message'];
}
