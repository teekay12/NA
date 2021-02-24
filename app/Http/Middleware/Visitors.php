<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\Request;

class Visitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Sentinel::check())
            return $next($request);
        else
            return redirect('/');
    }
}
