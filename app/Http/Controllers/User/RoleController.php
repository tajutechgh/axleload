<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Role;
use App\Model\user\Permission;
use Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::latest()->get();

        $permissions = Permission::all();

        return view('user.role.index',compact('roles','permissions')); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name'=>'required',
        ]);

        $role = new Role;

        $role->user_id=Auth::user()->id;
        $role->name=$request->name;

        $role->save();

        $role->permissions()->sync($request->permission);

        return redirect(route('role.index'))->with('message','Role added successfully');
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

            'name'=>'required',
        ]);

        $role = Role::find($id);

        $role->user_id=Auth::user()->id;
        $role->name=$request->name;

        $role->save();

        $role->permissions()->sync($request->permission);

        return redirect(route('role.index'))->with('message','Role updated successfully');
    }

    public function destroy($id)
    {
        Role::where('id',$id)->delete();

        return redirect()->back()->with('message','Role deleted successfully');
    }
}
