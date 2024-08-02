<?php

namespace App\Http\Middleware;
use GuzzleHttp\Client;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = new Client();
        $ip = $request->ip(); // Get the client's IP address

        try {
            $response = $client->get("http://ipinfo.io/{$ip}/json");
            $data = json_decode($response->getBody(), true);

            if (isset($data['country']) && $data['country'] === 'TN') {
                // IP is from Tunisia, do something
                return redirect()->to('http://tn.foodexpress.site');
            }
        } catch (\Exception $e) {
            // Handle exception
            return response()->json(['error' => 'Unable to check IP address'], 500);
        }




        return $next($request);
    }
}
