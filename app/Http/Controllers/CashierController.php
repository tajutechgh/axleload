<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\Transaction;
use App\Model\user\Overload_case;
use Carbon\Carbon;
use Auth;
use DB;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cashier');
    }

    public function cashier()
    {
    	$todayTransactions = Transaction::whereDate('created_at', Carbon::today())
    	                    ->where('station_id', '=', Auth::user()->station['id'])
    	                    ->count();

    	$todayOverloadVehicles = Transaction::whereDate('created_at', Carbon::today())
    	                        ->where('station_id', '=', Auth::user()->station['id'])
    	                        ->where('gross_excess_weight', '>', '0')
    	                        ->count();

        $todayFineAmounts = Transaction::whereDate('created_at', Carbon::today())
                        ->where('gross_excess_weight', '>', 0)
                        ->orWhere('excess_height', '>', 0)
                        ->orWhere('avoided_weighing', '=', 1)
                        ->get();

        $todayFinesCollected = Overload_case::whereDate('created_at', Carbon::today())
                                ->where('station_id', '=', Auth::user()->station['id'])
                                ->where('action', '=', 'fine')
                                ->orWhere('action', '=', 'partpayment')
                                ->sum('amount_paid');

        return view('user.cashier',compact('todayTransactions','todayOverloadVehicles','todayFinesCollected','todayFineAmounts')); 
    }
}
