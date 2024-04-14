<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotKiosResmi
{
    public function handle($request, Closure $next, $guard="kiosResmi")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect('/kios-resmi/login');
        }
        return $next($request);
    }
}