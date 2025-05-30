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
     * 
     * 
     */

    // protected function unauthenticated($request, array $guards)
    // {
    //     if ($request->expectsJson()) {
    //         return response()->json([
    //             'message' => 'Unauthenticated. Redirecting to login.',
    //             'redirect' => route('login')
    //         ], 401);
    //     }

    //     return redirect()->guest(route('login'));
    // }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
    
}
