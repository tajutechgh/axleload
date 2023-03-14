<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\System;
use Auth;

class SystemController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $systems = System::latest()->get();

        return view('user.system.index',compact('systems'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'company_name' => 'required',
            'system_name' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imagename = $request->image->getClientOriginalName();

            $request->image->storeAs('public',$imagename);

            $system = new System;

            $system->user_id=Auth::user()->id;
            $system->company_name=$request->company_name;
            $system->system_name=$request->system_name;
            $system->image = $imagename;

            $system->save();
        }

        return redirect(route('system.index'))->with('message','System details added successfully');
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

            'company_name' => 'required',
            'system_name' => 'required',
        ]);

        $system = System::find($id);

        $system->user_id=Auth::user()->id;
        $system->company_name=$request->company_name;
        $system->system_name=$request->system_name;

        if ($request->hasFile('image')) {

            $imagename = $request->image->getClientOriginalName();

            $request->image->storeAs('public',$imagename);

            $system->image = $imagename;
        }

        $system->save();

        return redirect(route('system.index'))->with('message','System details updated successfully');
    }

    public function destroy($id)
    {
        System::where('id',$id)->delete();

        return redirect()->back()->with('message','System details deleted successfully');
    }
}
