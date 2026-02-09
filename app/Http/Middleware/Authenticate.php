<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // Check which guard is being used
            if ($request->route()?->middleware()) {

            
                //// if user is tinatry pumasok sa authentication ng Customer
               ////  then redirect Customer login
                if (in_array('auth:customer', $request->route()->middleware())) {
                    return route('customer.login');
                }


                //// if user is tinatry pumasok sa authentication ng admin
               ////  then redirect admin login
                if (in_array('auth:web', $request->route()->middleware())) {
                    return route('login');
                }
            }

            // fallback
            return route('login');
        }
    }
}
