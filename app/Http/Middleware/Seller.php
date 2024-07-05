<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::guard('seller')->check()){
            return redirect()->route('seller.login.form')->with('error', 'Please Login First !');
        }
        if(Auth::guard('seller')->user()->id){
            if(Auth::guard('seller')->user()->status == 0){
                return redirect()->route('seller.pending');
            }else if(Auth::guard('seller')->user()->status == 2){
                return redirect()->route('seller.suspend');
            }else if(Auth::guard('seller')->user()->status == 3){
                return redirect()->route('seller.ban');
            }else if(Auth::guard('seller')->user()->status == 4){
                return redirect()->route('seller.disapproved');
            }else{
                return $next($request);
            }
        }
        return $next($request);
    }
}
