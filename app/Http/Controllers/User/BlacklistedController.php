<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Blacklist;
use Auth;

class BlacklistedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blacklists = Blacklist::latest()->where('status','=','pending')->get();

        return view('user.blacklist.index',compact('blacklists'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'blacklist_date'=>'required',
            'vehicle_number'=>'required',
            'officer_name'=>'required',
            'reason'=>'required',

        ]);

        $blacklist = new Blacklist;

        $blacklist->blacklist_date=$request->blacklist_date;
        $blacklist->vehicle_number=$request->vehicle_number;
        $blacklist->officer_name=$request->officer_name;
        $blacklist->reason=$request->reason;
        $blacklist->station_id=$request->station_id;
        $blacklist->station_name=$request->station_name;
        $blacklist->status=$request->status;
        $blacklist->user_id=Auth::user()->id;

        $blacklist->save();

        return redirect(route('blacklist.index'))->with('message','Blacklist added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blacklist = Blacklist::find($id);

        return view('user.blacklist.edit',compact('blacklist'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'blacklist_date'=>'required',
            'vehicle_number'=>'required',
            'officer_name'=>'required',
            'reason'=>'required',

        ]);

        $blacklist = Blacklist::find($id);

        $blacklist->blacklist_date=$request->blacklist_date;
        $blacklist->vehicle_number=$request->vehicle_number;
        $blacklist->officer_name=$request->officer_name;
        $blacklist->reason=$request->reason;
        $blacklist->station_id=$request->station_id;
        $blacklist->station_name=$request->station_name;
        $blacklist->status=$request->status;
        $blacklist->user_id=Auth::user()->id;

        $blacklist->save();

        return redirect(route('blacklist.index'))->with('message','Blacklist updated successfully');
    }

    public function destroy($id)
    {
        Blacklist::where('id',$id)->delete();

        return redirect()->back()->with('message','Blacklist deleted successfully'); 
    }

    public function arrest(Request $request, $id)
    {
        // dd($id);
        $blacklist = Blacklist::find($id);

        $blacklist->arrest_date=$request->arrest_date;
        $blacklist->officer_name=$request->officer_name;
        $blacklist->reason=$request->reason;
        $blacklist->status=$request->status;
        
        $blacklist->save();

        return redirect(route('blacklist.index'))->with('alert','Arrest Issued successfully');
    }
}
