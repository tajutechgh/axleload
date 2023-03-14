<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Fine;
use App\Model\user\Overload_case;
use App\Model\user\Transaction;
use App\Model\user\System;
use Auth;

class OverloadCaseController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $excessweights = Transaction::latest()->where('gross_excess_weight', '>', 0)
                                            ->orWhere('excess_height', '>', 0)
                                            ->orWhere('avoided_weighing', '=', 1)
                                            ->get();

        return view('user.overloadcases.index',compact('excessweights'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }

    public function overload(Request $request)
    {
        
        $excess_value = (int)$request['excess_value'];
        
        $fine = Fine::where([
                            ['min', '<=', $excess_value],
                            ['max', '>=', $excess_value]
                        ])
                    ->pluck('amount');
        return $fine;
    }

    public function invoice()
    {
        $systems = System::latest()->limit(1)->get();

        $transaction_fines=Overload_case::latest()->where('user_id','=', Auth::user()->id)->limit(1)->get();

        return view('user.overloadcases.invoice',compact('transaction_fines','systems')); 
    }
}
