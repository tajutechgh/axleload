<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Setting;

class SettingsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $settings = Setting::get()->pluck('value','key');

        return view('user.settings.index',compact('settings'));
    }

    public function update(Request $request)
    {
        	$fields = $request->all();
        	
        	foreach ($fields as $key => $value) {
        		setting() -> set($key, $value);
        	}

        	// Save all settings
        	setting()->save();

        	return redirect()->back();  
    }
}
