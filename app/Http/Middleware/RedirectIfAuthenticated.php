<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return RedirectResponse|mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Session::has('auth')) {
            return back();
        }

        return $next($request);
    }
}
