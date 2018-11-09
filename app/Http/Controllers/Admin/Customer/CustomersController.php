<?php

namespace App\Http\Controllers\Admin\Customer;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        return view('admin.customer.index')
                ->with('customers', Customer::orderBy('name')->get());
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer->delete()) {
            Session::flash('success','Customer deleted Successfully');
        }
        return redirect()->back();

    }
}
