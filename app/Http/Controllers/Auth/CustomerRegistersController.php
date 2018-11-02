<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Session;
use Illuminate\Http\Request;
use App\Mail\ConfirmYourEmail;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;

class CustomerRegistersController extends Controller
{
    public function register()
    {
        return view('auth.customer.customer_register');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:customers',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $customer =  Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirm_token' => str_random(25),
        ]);
        if ($customer) {
            Session::flash('reg_success','success');
        }
        Mail::to($customer)->send(new ConfirmYourEmail($customer));
        return redirect()->back();
    }
}
