<?php

namespace App\Models\Customer;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_active','confirm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Confirm a customer's email
     *
     * @return void
     */
    public function confirm()
    {
        $this->confirm_token = null;
        $this->is_active = true;
        $this->save();
    }

    /**
     * Get the CustomerInfo record associated with the model.
     */
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class);
    }
}
