<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotPemerintah
{
    public function handle($request, Closure $next, $guard="pemerintah")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect('/admin');
        }
        return $next($request);
    }
}
