<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StationAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('stationadmin');
    }

    public function stationAdmin()
    {
        return view('user.stationadmin'); 
    }
}
