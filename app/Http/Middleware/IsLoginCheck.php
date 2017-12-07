<?php

namespace App\Http\Middleware;

use Closure;

class IsLoginCheck
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
        if ($request->session()->has('user_data')) {
            return redirect()->route('mem.exam');
        }

        return $next($request);
    }
}
