<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubdomainRedirect
{
    public function handle(Request $request, Closure $next)
    {
       
        $hostParts = explode('.', $request->getHost());

        if (count($hostParts) > 2 && $hostParts[0] !== 'www') {
            $subdomain = $hostParts[0];
            $redirectUrl = "http://" . env('mainhost') . "/login{$request->getRequestUri()}";
             //  $redirectUrl = "http://{$subdomain}" . env('mainhost') . "/store";
         
            if ($request->path() !== '/') {
                /*if (!Auth::check()) {
                     return redirect('/store'); // or any other login route
                }*/
            }
            
            return redirect($redirectUrl);
        }

        return $next($request);
    }
	/*public function handle(Request $request, Closure $next)
{
    $hostParts = explode('.', $request->getHost());

    if (count($hostParts) > 2 && $hostParts[0] !== 'www') {
        $subdomain = $hostParts[0];

        // Check if the request is already for the correct subdomain URL
        if ($subdomain !== 'store') {
            $redirectUrl = "http://{$subdomain}" . env('mainhost') . ";
            return redirect($redirectUrl);
        }
    }

    return $next($request);
}
    */
}
