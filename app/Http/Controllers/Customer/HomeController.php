<?php

namespace App\Http\Controllers\Customer;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.customer.dashboard');
    }
}
