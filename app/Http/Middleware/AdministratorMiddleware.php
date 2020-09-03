<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdministratorMiddleware
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
        if (Auth::user())
        {
            $is_administrator = Auth::user()->hasRole('administrator');
            if ($is_administrator)
            {
                return $next($request);
            }
            return redirect()->route('errors.forbidden');
        }
        return redirect()->route('home');
    }
}
