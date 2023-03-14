<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)  
    {
        if (Auth::guard($guard)->check()) {

            return redirect('/home');

            // $auth = Auth::user()->roles()->first();

            // switch ($auth->role) {
            //     case 'System Admin':
            //             return  redirect()->route('home');    
            //         break;
            //     case 'National Admin':
            //             return  redirect()->route('nationaladmin'); 
            //         break;
            //     case 'Regional Admin':
            //             return  redirect()->route('regionaladmin');  
            //         break;
            //     case 'Station Admin':
            //             return  redirect()->route('stationadmin');  
            //         break;
            //     case 'Cashier':
            //             return  redirect()->route('cashier');  
            //         break;
            //     case 'Weighing Officer':
            //             return  redirect()->route('weighingofficer');  
            //         break;
            //     case 'Overload Entry Clerk':
            //             return  redirect()->route('overloadentryclerk');  
            //         break;

            //     default:
            //         # code...
            //         return  redirect()->route('login');  
            //         break;
            // }   
        }

        return $next($request);
    }
}
