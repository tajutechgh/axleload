<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Fine;
use Auth;

class FineController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fines = Fine::latest()->get();

        return view('user.fine.index',compact('fines'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'min'=>'required',
            'max'=>'required',
            'amount'=>'required',

        ]);

        $fine = new Fine;

        $fine->user_id=Auth::user()->id;
        $fine->min=$request->min;
        $fine->max=$request->max;
        $fine->amount=$request->amount;

        $fine->save();

        return redirect(route('fine.index'))->with('message','Fine added successfully');
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

            'min'=>'required',
            'max'=>'required',
            'amount'=>'required',

        ]);

        $fine = Fine::find($id);

        $fine->user_id=Auth::user()->id;
        $fine->min=$request->min;
        $fine->max=$request->max;
        $fine->amount=$request->amount;

        $fine->save();

        return redirect(route('fine.index'))->with('message','Fine updated successfully');
    }

    public function destroy($id)
    {
        Fine::where('id',$id)->delete();

        return redirect()->back()->with('message','Fine deleted successfully');
    }
}
