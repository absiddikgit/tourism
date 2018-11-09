<?php

namespace App\Http\Controllers\Frontend;

use Session;
use Illuminate\Http\Request;
use App\Models\Frontend\Contact;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function index()
    {
        return view('frontend.site.contact');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if (Contact::create($request->all())) {
            Session::flash('success','Your message send successfully');
        }
        return redirect()->back();

    }
}
