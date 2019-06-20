<?php

namespace SPS\Http\Middleware;

use Closure;

class Patient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && (Auth::user()->isPatient() || Auth::user()->isAdmin()) ) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
