<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\System;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('systemadmin');
    }

    public function index()
    {
        return view('user.index'); 
    }
}
