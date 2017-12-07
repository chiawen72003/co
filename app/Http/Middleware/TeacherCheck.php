<?php

namespace App\Http\Middleware;

use Closure;

class TeacherCheck
{
    private $com_level = array(
        21,22,23,31
    );
    public function handle($request, Closure $next, $guard = null)
    {
        if ( !$request->session()->has('user_data.access_level') OR
             !in_array($request->session()->get('user_data.access_level'),$this->com_level)
            )
        {
            return redirect()->route('ad.logout');
        }

        return $next($request);
    }
}
