<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OverloadEntryClerkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach (Auth::user()->roles as $role) {
            if ($role->name == 'Overload Entry Clerk') {
                return $next($request);
            }
        }

        return redirect('/login');
    }
}
