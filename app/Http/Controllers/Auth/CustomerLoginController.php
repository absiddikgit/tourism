<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:customer');
        // $this->middleware('guest', ['except' => 'logout']);
    }
    public function showLoginForm()
    {
        return view('auth.customer.customer_login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
            if (Auth::guard('customer')->user()->is_active) {
                return redirect()->intended(route('customer.dashboard'));
            }else {
                $request->session()->flush();
                return $this->sendFailedLoginResponse($request)->withErrors(['active' => 'You must be active to login.']);
            }
    	}

    	return $this->sendFailedLoginResponse($request);
    }
}
