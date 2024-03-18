<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LivraisonRestaurant;



class MentionsLegalesController extends Controller
{
    public function show(Request $request)
{
    $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain);
 $client = Client::where('url_platform', $subdomain)->firstOrFail();
		//dd($client);
$livraisons = LivraisonRestaurant::where('restaurant_id', $client->id)->get();

	    $cart = session()->get('cart', []);
		 $user = User::findOrFail($client->user_id);
		
        return view('client.mentions-legales', compact('subdomain','client', 'cart','user','livraisons'));
    }
}
