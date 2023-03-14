<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Vehicle_type;
use App\Model\user\Axles_number;
use DB;
use Auth;

class VehicleTypeController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vehicletypes = Vehicle_type::latest()->get();

        return view('user.vehicletype.index',compact('vehicletypes'));
    }

    public function create()
    {
        return view('user.vehicletype.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'description' => 'required',
            'gross_weight' => 'required',
            'axles_number' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $imagename = $request->image->getClientOriginalName();

            $request->image->storeAs('public',$imagename);

            $vehicletype = new Vehicle_type;

            $vehicletype->user_id=Auth::user()->id;
            $vehicletype->description=$request->description;
            $vehicletype->gross_weight=$request->gross_weight;
            $vehicletype->axles_number=$request->axles_number;
            $vehicletype->image = $imagename;

            if ($vehicletype->save()) {
                
                $id = $vehicletype->id;
                
                foreach ($request->weight as $key => $value) {

                    $data = array('vehicleType_id'=>$id,
                                  'weight'=>$value,
                                  'normal_esal'=>$request->normal_esal[$key]);
                    Axles_number::insert($data);
                }
            }
        }

        return redirect(route('vehicletype.index'))->with('message','Vehicle type added successfully');
    }

    public function show($id)
    {
        $vehicletype =  Vehicle_type::find($id);

        $vehicletypes = Vehicle_type::find($id)->axles_numbers;

        return view('user.vehicletype.show',compact('vehicletype','vehicletypes')); 
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $vehicle = Vehicle_type::findOrFail($id);

        $vehicletypes = Vehicle_type::where('id', $vehicle->id)->get();

        foreach ($vehicletypes as $vehicletype) {

            DB::table('axles_numbers')->where('vehicleType_id', $vehicletype->id)->delete();
        }

        Vehicle_type::where('id', $vehicle->id)->delete();

        return redirect()->back()->with('message','Vehicle type deleted successfully');
    }
}
