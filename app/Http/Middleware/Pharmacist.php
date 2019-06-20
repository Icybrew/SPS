<?php

namespace SPS\Http\Middleware;

use Closure;

class Pharmacist
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
        if ( Auth::check() && (Auth::user()->isPharmacist() || Auth::user()->isAdmin()) ) {
            return $next($request);
        } else {
            return abort(404);
        }
    }
}
