<?php

namespace App\Http\Middleware;

use Closure;

class EnsureIsAdminUser
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
        if (! $request->user()->hasRole('administrador')) {
            return redirect('/');
        }
 
        return $next($request);
    }
}
