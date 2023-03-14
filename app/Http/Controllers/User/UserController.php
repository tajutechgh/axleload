<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Role;
use App\Model\user\User;
use App\Model\user\Station;
use Auth;

class UserController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        $roles = Role::all();

        $stations = Station::all();

        return view('user.user.index',compact('roles','users','stations'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required|string|max:255',

            'username' => 'required|string|unique:users',

            'station_id' => 'required|string',

            'password' => 'required|string|min:6|confirmed',
        ]);

        $request['password'] = bcrypt($request->password);

        $user = User::create($request->all());

        $user->roles()->sync($request->role);

        return redirect(route('user.index'))->with('message','User added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'name' => 'required|string|max:255',

            'username' => 'required|string',

            'station_id' => 'required|string',
        ]);

        // $request->status? : $request['status']=0;

        $user = User::where('id',$id)->update($request->except('_token','_method','role'));

        User::find($id)->roles()->sync($request->role);

        return redirect(route('user.index'))->with('message','User updated successfully');
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return redirect()->back()->with('message','User deleted successfully');
    }
}
