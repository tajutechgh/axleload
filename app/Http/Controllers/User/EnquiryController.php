<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\user\Transaction;
use App\Model\user\System;
use App\Model\user\Axles_number;
use App\Model\user\Overload_case;
use Auth;

class EnquiryController extends Controller 
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function weighingEnquiry()
    {
        $transactions = Transaction::latest()->get();

        return view('user.enquiry.weighing',compact('transactions'));
    }

    public function weighingDetails($id)
    {
    	$systems = System::latest()->limit(1)->get();

        $transaction = Transaction::find($id);

        $trans_axles = Transaction::find($id)->trans_axles;

        return view('user.enquiry.invoice',compact('transaction','trans_axles','systems'));
    }

    public function finesEnquiry()
    {
        $fines = Overload_case::latest()->get();

        return view('user.enquiry.fines',compact('fines'));
    }

    public function finesDetails($id)
    {
    	$systems = System::latest()->limit(1)->get();

        $fine = Overload_case::find($id);

        return view('user.enquiry.receipt',compact('fine','systems'));
    }
    
}
