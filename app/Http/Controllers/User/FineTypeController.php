<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Fine_type;

class FineTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $finetypes = Fine_type::latest()->get();

        return view('user.finetype.index',compact('finetypes'));
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

        $finetype = new Fine_type;

        $finetype->name=$request->name;

        $finetype->save();

        return redirect(route('finetype.index'))->with('message','Fine type added successfully');
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

        $finetype = Fine_type::find($id);

        $finetype->name=$request->name;

        $finetype->save();

        return redirect(route('finetype.index'))->with('message','Fine type updated successfully');
    }

    public function destroy($id)
    {
        Fine_type::where('id',$id)->delete();

        return redirect()->back()->with('message','Fine type deleted successfully');
    }
}
