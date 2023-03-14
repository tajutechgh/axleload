<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OverloadEntryClerkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('overloadentryclerk');
    }

    public function overLoadEntryClerk()
    {
        return view('user.overloadentryclerk'); 
    }
}
