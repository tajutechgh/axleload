<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NationalAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('nationaladmin');
    }

    public function nationalAdmin()
    {
        return view('user.nationaladmin'); 
    }
}
