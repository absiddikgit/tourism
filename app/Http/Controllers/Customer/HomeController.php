<?php

namespace App\Http\Controllers\Customer;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerInfo;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.customer.dashboard');
    }

    public function profile()
    {
        return view('frontend.customer.profile')
                ->withUser(Customer::find(Auth::guard('customer')->user()->id));
    }

    public function profileStore(Request $request)
    {
        $user_id = Auth::guard('customer')->user()->id;

        $this->validate($request,[
            'name'           => 'required|string|max:255',
            'contact_number' => 'required|max:255',
            'country'        => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:255',
            'postcode'       => 'required|max:255',
        ]);

        if ($customerInfo = CustomerInfo::where('customer_id',$user_id)->first()) {
            Session::flash('success','Successfully Profile updated');
            $customerInfo->update($request->all());
        }else {
            $request['customer_id'] = $user_id;
            Session::flash('success','Successfully Profile updated');
            CustomerInfo::create($request->all());
        }
        return redirect()->back();
    }

    public function changePassword($value='')
    {
        // code...
    }
}
