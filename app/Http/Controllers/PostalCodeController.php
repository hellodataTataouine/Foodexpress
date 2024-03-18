<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientPostalCode;
use App\Models\Client;

class PostalCodeController extends Controller
{
    public function validatePostalCode(Request $request)
    {
        $subdomain = $request->getHost();
        $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
        // Check if the subdomain exists in the clients table
        $idRestaurant = Client::where('url_platform', $subdomain)->value('id');
        $code = $request->input('postal_code');
        // Check if the code exists in the database
        $codeExists = ClientPostalCode::where('postal_code', $code)
        ->where('client_id', $idRestaurant)
        ->exists();
        
     if (!$codeExists) {
            $phoneNum1 = Client::where('id', $idRestaurant)->value('phoneNum1');
            
            $email = Client::where('id', $idRestaurant)->first()->user->email;
        
            session()->put('phoneNum1', $phoneNum1);
            session()->put('email', $email);
        }
        // Set the session variable based on the code validation
        session()->put('showPopup', $codeExists);
        // Redirect back to the previous page
        return redirect()->back();
    }

    
}
