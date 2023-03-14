<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionalAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('regionaladmin');
    }

    public function regionalAdmin()
    {
        return view('user.regionaladmin'); 
    }
}
