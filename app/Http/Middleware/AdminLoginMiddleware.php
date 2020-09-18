<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->status == 1) {
                if ($user->tk == 1 || $user->tk == 2) {
                    return $next($request);
                }
                else {
                    return redirect('/home');
                }
            }
            else {
                $geturl = $request->path();
                $url = str_replace('/', '&', $geturl);
                return redirect('/checkLogin/redirect_url/' . $url);
            }
        }
        else {
            $geturl = $request->path();
            $url = str_replace('/', '&', $geturl);
            return redirect('/checkLogin/redirect_url/' . $url);
        }

    }
}
