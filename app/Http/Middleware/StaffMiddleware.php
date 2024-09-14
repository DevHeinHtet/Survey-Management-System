<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->is_active){
            $suspeded = Auth::user()->is_active == "0";
            Auth::guard('staff')->logout();

            if($suspeded == 1){
                $message = [
                    'errors' => 'Your account has been suspeded. Please contact adminstractor'
                ];
            }

            return response()->json($message, 200);
        }
        if(Auth::check()){
            $expireAt = now()->addMinutes(2);
            Cache::remember("user-is-online-" . Auth::user()->id, $expireAt, function () {
                return true;
            });
        }
        return $next($request);
    }
}
