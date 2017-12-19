<?php

namespace App\Http\Middleware;

use Closure;

class AdSessionCheck
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ( !$request->session()->has('user_type') OR
             $request->session()->get('user_type') != 'Admin'
            )
        {
            return redirect()->route('member.login');
        }

        return $next($request);
    }
}
