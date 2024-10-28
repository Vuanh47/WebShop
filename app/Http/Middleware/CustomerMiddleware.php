<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private $cus;
    public function __construct(){

    }
    public function handle(Request $request, Closure $next, $guard = 'cus'): Response
    {
        if(FacadesAuth::guard($guard)->check()){
            return $next($request);
        }
        return redirect()->route('login')->with('error','Bạn cần đăng nhập');
    }
}
