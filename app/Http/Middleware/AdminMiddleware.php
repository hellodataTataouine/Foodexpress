<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;



class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin != 1) {
            return redirect()->route('login')->with('error', 'You don\'t have access to this page.');
        }

        return $next($request);
    }

}