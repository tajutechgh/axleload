<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Station;
use App\Model\user\Region;
use Auth;

class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stations = Station::latest()->get();

        return view('user.station.index',compact('stations'));
    }

    public function create()
    {
        $regions = Region::all();

        return view('user.station.create',compact('regions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'station_name'=>'required',
            'operating_company'=>'required',
            'weighing_device'=>'required',
            'contact_person'=>'required',
            'contact_number'=>'required',
            'station_code'=>'required|unique:stations',
            'tolerance_weight'=>'required',
            'region_id'=>'required',
        ]);

        $station = new Station;

        $station->user_id=Auth::user()->id;
        $station->station_name=$request->station_name;
        $station->operating_company=$request->operating_company;
        $station->weighing_device=$request->weighing_device;
        $station->contact_number=$request->contact_number;
        $station->contact_person=$request->contact_person;
        $station->station_code=$request->station_code;
        $station->tolerance_weight=$request->tolerance_weight;
        $station->region_id=$request->region_id;

        $station->save();

        return redirect(route('station.index'))->with('message','Station added successfully');
    }

    public function show($id)
    {
        $station = Station::find($id);

        return view('user.station.show',compact('station'));
    }

    public function edit($id)
    {
        $station = Station::find($id);

        $regions = Region::all();

        return view('user.station.edit',compact('station','regions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'station_name'=>'required',
            'operating_company'=>'required',
            'weighing_device'=>'required',
            'contact_person'=>'required',
            'contact_number'=>'required',
            'station_code'=>'required',
            'tolerance_weight'=>'required',
            'region_id'=>'required',

        ]);

        $station = Station::find($id);

        $station->user_id=Auth::user()->id;
        $station->operating_company=$request->operating_company;
        $station->weighing_device=$request->weighing_device;
        $station->contact_number=$request->contact_number;
        $station->contact_person=$request->contact_person;
        $station->station_code=$request->station_code;
        $station->tolerance_weight=$request->tolerance_weight;
        $station->region_id=$request->region_id;

        $station->save();

        return redirect(route('station.index'))->with('message','Station updated successfully');
    }

    public function destroy($id)
    {
        Station::where('id',$id)->delete();

        return redirect()->back()->with('message','Station deleted successfully');
    }
}
