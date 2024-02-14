<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
            $role = Auth::User()->role_id;
            // switch ($role) {
            //     case '1':
            //         return redirect(RouteServiceProvider::HOME);;;
            //     break;
    
            //     case '2':
            //         return redirect('Requests');
            //     break;
            //     default:
            //         return '/';
            //     break;
            // }
            return redirect('Requests');
        }

        return $next($request);
    }
}
