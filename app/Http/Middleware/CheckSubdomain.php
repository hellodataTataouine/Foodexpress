<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Client;
class CheckSubdomain
{
   /* public function handle($request, Closure $next)
    {
        
        $subdomain = $request->getHost();
        $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
        // Remove the port number if present
        if($subdomain == env('mainhost')){
            $client = 1;
        } else {
            // Check if the subdomain exists in the clients table
            $client = Client::where('url_platform', $subdomain)->first();
        }

        if (!$client) {
            // Subdomain doesn't exist, redirect to a 404 page
           //  echo $subdomain;
            abort(404);
        }
        // Set the client model instance on the request object for later use if needed
        $request->client = $client;
      //  dd($next($request));
        return $next($request);
        
    }*/


    public function handle(Request $request, Closure $next)
    {
        $hostParts = explode('.', $request->getHost());
    
        if (count($hostParts) > 2 && $hostParts[0] !== 'www') {
            $subdomain = $hostParts[0];
    
            // Check if the request is already for the correct subdomain URL
            if ($subdomain !== 'store') {
                $redirectUrl = "http://{$subdomain}." .env('mainhost') ;
                return redirect($redirectUrl);
            }
        }
    
        return $next($request);
    }



}
