<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class checkShipper
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
        if(!Auth::check()){
            return route('403');
        }else{
            $user=Auth::user();
            if($user->role!="shipper"){
                return redirect('/403');
            }
        }

        return $next($request);
    }
}
