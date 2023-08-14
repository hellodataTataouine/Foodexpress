<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ClientPostalCode;

class ValidatePostalCodeMiddleware
{
    public function handle($request, Closure $next)
    {
        $code = $request->input('postal_code');
        
        // Check if the code exists in the database
        $codeExists = ClientPostalCode::where('postal_code', $code)->exists();

        // Set the session variable based on the code validation
        if ($codeExists) {
            session()->put('showPopup', false);
        } else {
            session()->put('showPopup', true);
        }

        return $next($request);
    }
}
