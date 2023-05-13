<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    public function handle($request, Closure $next, ...$guards)
    {

        // if (!auth()->check()) {
        //     return redirect('/login');
        // } else {
        //     $roles = Auth::user()->getRoleNames();

        //     // Check user role
        //     // if ($roles->contains('super admin'))
        //     //     return '/admin';
        //     // else if ($roles->contains('company'))
        //     //     return '/company';
        //     if ($roles->contains('customer'))
        //         return redirect()->route('customer.order.list');
        //     // else
        //         // return '/';
        // }

        return parent::handle($request, $next, ...$guards);
    }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            switch (Request::segment(1)) {
                case 'admin':
                    return route('admin.login.form');
                    break;
                case 'customer':
                    return route('login');
                    break;
                default:
                    return route('login');
                    break;
            }
        }
    }
}
