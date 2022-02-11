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
            if (Auth::user()->roles()->first()->slug == 'admin') {
                return redirect('admin');
            } else if (Auth::user()->roles()->first()->slug == 'customer' ) {
                return redirect('orders/customerOrders/'.Auth::user()->id);
            }
            else if (Auth::user()->roles()->first()->slug == 'employee' ) {
                return redirect('employees_dashboard');
            }
            else {
                // return redirect('/login');
            }
        }

        return $next($request);
    }
}
