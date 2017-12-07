<?php

namespace App\Http\Middleware;

use Closure;

class AdSessionCheck
{
    private $ad_level = array(
        '91','92'
    );
    public function handle($request, Closure $next, $guard = null)
    {
        if ( !$request->session()->has('user_data.access_level') OR
             !in_array($request->session()->get('user_data.access_level'),$this->ad_level)
            )
        {
            return redirect()->route('ad.logout');
        }

        return $next($request);
    }
}
