<?php

namespace App\Http\Controllers\Admin\Contact;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frontend\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        return view('admin.contact.index')
                ->with('messages', Contact::latest()->get());
    }

    public function destroy($id)
    {
        $customer = Contact::find($id);
        if ($customer->delete()) {
            Session::flash('success','Message deleted Successfully');
        }
        return redirect()->back();

    }
}
