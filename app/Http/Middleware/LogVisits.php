<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Visit;
use App\Services\GeoIPService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $excludedRoutes = [
        'admin.*', // Example: Exclude all routes under 'admin' prefix
        'api.*',   // Example: Exclude all API routes
    ];
    public function handle(Request $request, Closure $next)
    {
        $geoIPService = new GeoIPService();
        $ip = $request->ip(); // Get user's IP address

        $country = $geoIPService->getCountryFromIp($ip);
        $routeName = $request->route()->getName();
        // Check if route name is null (route not named)
        if(!$country){
            $country="FR";
        }
        if (!$routeName) {
            return $next($request); // Skip logging if route name is null
        }
        foreach ($this->excludedRoutes as $pattern) {
            if (Str::is($pattern, $routeName)) {
                return $next($request); // Skip counting visits for excluded routes
            }
        }
        // Update or insert the visit count for this route

        //$country = GeoIP::getLocation()->getAttribute('iso_code');
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {

        $restaurant = $user->restaurant;
        Visit::create(
            ['route_name' => $routeName,
            "country"=>$country,
            'restaurant_id'=>$restaurant->id,
        ],
        );
    }
        return $next($request);
    }
}
