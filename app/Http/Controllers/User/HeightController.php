<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Height;
use Auth;

class HeightController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $heights = Height::latest()->get();

        return view('user.height.index',compact('heights'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'standard_height'=>'required',

        ]);

        $height = new Height;

        $height->user_id=Auth::user()->id;
        $height->standard_height=$request->standard_height;

        $height->save();

        return redirect(route('height.index'))->with('message','Height added successfully');
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

            'standard_height'=>'required',

        ]);

        $height = Height::find($id);

        $height->user_id=Auth::user()->id;
        $height->standard_height=$request->standard_height;

        $height->save();

        return redirect(route('height.index'))->with('message','Height updated successfully');
    }

    public function destroy($id)
    {
        Height::where('id',$id)->delete();

        return redirect()->back()->with('message','Height deleted successfully');
    }
}
