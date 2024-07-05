<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('web')->check()){
            return redirect()->route('login')->with('error', 'Please Login First !');
        }
        if(Auth::guard('web')->user()->id){
            if(Auth::guard('web')->user()->status == 1){
                return redirect()->route('user.suspend');
            }else if(Auth::guard('web')->user()->status == 2){
                return redirect()->route('user.ban');
            }else{
                return $next($request);
            }
        }
        return $next($request);
    }
}
