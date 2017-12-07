<?php

namespace App\Http\Middleware;

use Closure;

class LoginDataCheck
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

		if( null === $request->get('username') OR $request->get('username') == '' ){
			return redirect()->back()->with('error', ['your message,here']); 
		}
        if( null === $request->get('password') OR $request->get('password') == ''  ){
			return redirect()->back()->with('error', ['your message,here']); 
		}

        return $next($request);
    }
}
