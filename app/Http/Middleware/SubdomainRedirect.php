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
            $redirectUrl = "http://localhost:8000/login{$request->getRequestUri()}";
            
            if ($request->path() !== '/') {
                if (!Auth::check()) {
                    return redirect('client/login'); // or any other login route
                }
            }
            
            return redirect($redirectUrl);
        }

        return $next($request);
    }
    
}
