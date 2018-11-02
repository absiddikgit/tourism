<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;

class ConfirmEmailController extends Controller
{
    public function index()
    {
        $user = Customer::where('confirm_token', request('token'))->first();

    	if($user) {
    		$user->confirm();
    		session()->flash('success', 'Your email has been confirmed.');
    		return redirect('/');
    	} else {
    		session()->flash('error', 'Confirmation token not recognised.');
    		return redirect('/');
    	}
    }
}
