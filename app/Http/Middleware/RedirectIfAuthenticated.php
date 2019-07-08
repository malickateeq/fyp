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
        //If already logged in don't show login pages and redirect to panel
        if (Auth::guard($guard)->check()) 
        {
            //return redirect('/home');
            if ( Auth::user()->isRider() ) {
                 return redirect(route('rider'));
            }
            // allow admin to proceed with request
            else if ( Auth::user()->isAdmin() ) {
                return redirect(route('admin'));
            }
            else if ( Auth::user()->isDriver() ) {
                return redirect(route('driver'));
            }
        }

        //If not loggin then go to the login page
        return $next($request);
    }
}
