<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Region;
use Auth;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $regions = Region::latest()->get();

        return view('user.region.index',compact('regions')); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'region_name'=>'required',

        ]);

        $region = new Region;

        $region->user_id=Auth::user()->id;
        $region->region_name=$request->region_name;

        $region->save();

        return redirect(route('region.index'))->with('message','Region added successfully');
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

            'region_name'=>'required',

        ]);

        $region = Region::find($id);

        $region->user_id=Auth::user()->id;
        $region->region_name=$request->region_name;

        $region->save();

        return redirect(route('region.index'))->with('message','Region updated successfully');
    }

    public function destroy($id)
    {
        Region::where('id',$id)->delete();

        return redirect()->back()->with('message','Region deleted successfully');
    }
}
