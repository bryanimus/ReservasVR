<?php

namespace App\Http\Middleware;

use Closure;

class checkRoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $opcion)
    {
        if (auth()->user()->accOpcion($opcion))
            return $next($request);

        return redirect('/');
    }
}
