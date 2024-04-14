<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotPetani
{
    public function handle($request, Closure $next, $guard="petani")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect('/petani/login');
        }
        return $next($request);
    }
}
