<?php

namespace App\Http\Middleware;

use Closure;

class IsAdLoginCheck
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
        if ($request->session()->has('admin_data')) {
            return redirect()->route('ad.news.list');
        }

        return $next($request);
    }
}
