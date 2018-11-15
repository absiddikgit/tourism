<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $fillable = ['customer_id','contact_number','country','address','city','postcode','NID'];
}
