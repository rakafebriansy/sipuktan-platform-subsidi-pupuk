<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // if($request->hasCookie('uuid')) {
        //     return $next($request);    
        // }
        if(Session::get('role') == $role) {
            return $next($request);
        }
        return response()->redirectTo("$role/login");
    }
}
