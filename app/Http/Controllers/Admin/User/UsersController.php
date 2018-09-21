<?php

namespace App\Http\Controllers\Admin\User;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index')
                ->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required|email|min:3|unique:users',
            'password' => 'required|min:6|max:50|confirmed',
            'status' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = $request->status;
        if ($request->is_admin) {
            $user->is_admin = $request->is_admin;
        }

        if ($user->save()) {
            Session::flash('success','Successfully user created');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.user.edit')
                ->with('user', User::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required|email|min:3|unique:users,email,'.$id,
            'status' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        if ($request->is_admin) {
            $user->is_admin = $request->is_admin;
        }else {
            $user->is_admin = false;
        }

        if ($user->save()) {
            Session::flash('success','Successfully user updated');
        }
        return redirect()->route('user.index');
    }

    public function user_activate($user_id)
    {
        $user = User::find($user_id);

        $user->status = true;

        if ($user->save()) {
            Session::flash('success','Successfully user activated');
        }
        return redirect()->route('user.index');
    }

    public function user_deactivate($user_id)
    {
        $user = User::find($user_id);

        $user->status = false;

        if ($user->save()) {
            Session::flash('success','Successfully user deactivated');
        }
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            Session::flash('success','Successfully user deleted');
        }
        return redirect()->back();
    }
}
