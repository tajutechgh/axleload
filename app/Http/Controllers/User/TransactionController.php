<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\user\Height;
use App\Model\user\Vehicle_type;
use App\Model\user\Axles_number;
use App\Model\user\Commodity;
use App\Model\user\System;
use App\Model\user\Transaction;
use App\Model\user\Blacklist;
use App\Model\user\Trans_axles;
use App\Model\user\Overload_case;
use Auth;
use Storage;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $heights = Height::all();

        $vehicletypes = Vehicle_type::all();

        $commodities = Commodity::all();

        return view('user.transaction.index',compact('heights','vehicletypes','commodities'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'vehicleType_id' => 'required',
            'vehicle_number' => 'required',
            'commodity_id' => 'required',
            'height_id' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'goods_type' => 'required',
            'transaction_date' => 'required',
            'transaction_time' => 'required',
            'gross_actual_weight' => 'required',
            'gross_excess_weight' => 'required',
            'actual_height' => 'required',
        ]);

        $transaction = new Transaction;

        $transaction->user_id=Auth::user()->id;
        $transaction->attendant=Auth::user()->name;
        $transaction->vehicleType_id=$request->vehicleType_id;
        $transaction->vehicle_number=$request->vehicle_number;
        $transaction->commodity_id=$request->commodity_id;
        $transaction->height_id=$request->height_id;
        $transaction->station_id=$request->station_id;
        $transaction->origin=$request->origin;
        $transaction->destination=$request->destination;
        $transaction->goods_type=$request->goods_type;
        $transaction->transaction_date=$request->transaction_date;
        $transaction->transaction_time=$request->transaction_time;
        $transaction->gross_actual_weight=$request->gross_actual_weight;
        $transaction->gross_excess_weight=$request->gross_excess_weight;
        $transaction->avoided_weighing=$request->avoided_weighing;
        $transaction->officer_name=$request->officer_name;
        $transaction->invoice_number=$request->invoice_number;
        $transaction->fine_amount=$request->fine_amount;
        $transaction->excess_height=$request->excess_height;
        $transaction->actual_height=$request->actual_height;
        $transaction->region_name=$request->region_name;
        $transaction->station_name=$request->station_name;
        $transaction->vehicleType=$request->vehicleType;

        if ($transaction->save()) {
            
            $id = $transaction->id;
            
            foreach ($request->actual_weight as $key => $value) {

                $data = array('transaction_id'=>$id,
                              'actual_weight'=>$value,
                              'actual_esal'=>$request->actual_esal[$key],
                              'acceptable_weight'=>$request->acceptable_weight[$key],
                              'acceptable_esal'=>$request->acceptable_esal[$key],
                              'excess_esal'=>$request->excess_esal[$key],
                              'excess_weight'=>$request->excess_weight[$key]);
                Trans_axles::insert($data);
            }
        }
        
        return redirect(route('invoice'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $excess = Transaction::find($id);

        return view('user.overloadcases.edit',compact('excess'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'action'=>'required',
            'payment_date'=>'required',
            'invoice_number'=>'required',
        ]);

        $transaction = Transaction::find($id);

        $transaction->status=$request->status;

        if ($transaction->save()) {

            $ids = $transaction->id;

            $transaction_fine = new Overload_case;

            $transaction_fine->user_id=Auth::user()->id;
            $transaction_fine->station_id=$request->station_id;
            $transaction_fine->transaction_id=$ids;
            $transaction_fine->excess_height_fine=$request->excess_height_fine;
            $transaction_fine->excess_weight_fine=$request->excess_weight_fine;
            $transaction_fine->avoided_weighing_fine=$request->avoided_weighing_fine;
            $transaction_fine->total_fine=$request->total_fine;
            $transaction_fine->amount_paid=$request->amount_paid;
            $transaction_fine->balance_amount=$request->balance_amount;
            $transaction_fine->invoice_number=$request->invoice_number;
            $transaction_fine->payment_date=$request->payment_date;
            $transaction_fine->remarks=$request->remarks;
            $transaction_fine->action=$request->action;
            $transaction_fine->vehicle_number=$request->vehicle_number;
            $transaction_fine->payment_mode=$request->payment_mode;
            $transaction_fine->check_number=$request->check_number;
            $transaction_fine->mobile_money_number=$request->mobile_money_number;

            $transaction_fine->save();
        }

        return redirect(route('reciept'));
    }

    public function destroy($id)
    {
        //
    }

    public function vehicleDetails(Request $request)
    {

        $vehicle = Vehicle_type::with('axles_numbers')->findorFail($request['vehicleId']); 

        $vehicle->image = Storage::disk('local')->url($vehicle->image); 

        return $vehicle;
    }

    public function invoice()
    {
        $systems = System::latest()->limit(1)->get();

        $transactions=Transaction::latest()->where('user_id','=', Auth::user()->id)->limit(1)->get();

        return view('user.transaction.invoice',compact('transactions','systems'));
    }

    public function blacklisted(Request $request)
    {
        $blacklisted =  Blacklist::where('vehicle_number', $request['vehicle_number'])
                            ->whereStatus('pending')
                            ->first();
        
        $blacklisted->url = route('blacklist.edit',$blacklisted->id);

        if ($blacklisted) {
            return response()->json([

                'success' => true,

                'blacklist' => $blacklisted,
            ]);
        }else{
            return response()->json([

                'success' => false,
            ]);
        }
    }
}
