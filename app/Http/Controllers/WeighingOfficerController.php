<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeighingOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('weighingofficer');
    }

    public function weighingOfficer()
    {
        return view('user.weighingofficer'); 
    }
}
