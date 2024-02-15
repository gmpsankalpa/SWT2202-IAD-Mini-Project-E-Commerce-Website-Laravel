<?php

namespace App\Http\Middleware;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->utype==='ADM'){
            return $next($request);
        }else{
            session()->flush();
            return redirect()->route('login');
        }
        
    }
}
