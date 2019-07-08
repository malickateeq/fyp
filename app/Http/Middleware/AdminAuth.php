<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if( Auth::check() )
        {
            // if user admin take him to his dashboard
            if ( Auth::user()->isRider() ) {
                return redirect(route('rider'));
           }
           // allow admin to proceed with request
           else if ( Auth::user()->isAdmin() ) {
                return $next($request);
           }
           else if ( Auth::user()->isDriver() ) {
               return redirect(route('driver'));
           }
        }

        abort(404);  // for other user throw 404 error
    }
}
