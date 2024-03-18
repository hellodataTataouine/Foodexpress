<?php
    
namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use App\Models\PaimentRestaurant;
use App\Models\PaimentMethod;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
		   $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain);
 $client = Client::where('url_platform', $subdomain)->firstOrFail();
	    $cart = session()->get('cart', []);
	   
	   $user = User::findOrFail($client->user_id);
		
		        $totalPrice = $this->calculateTotalPrice($cart);
		
				
        return view('client.paiement-carte-bancaire', compact('subdomain','client', 'cart', 'user', 'totalPrice'));
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
public function stripePost(Request $request, $subdomain, $paymentMethodId)
{
	//dd($request);
	
	  $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain);
    $client = Client::where('url_platform', $subdomain)->firstOrFail();
//dd($client);
    // Retrieve the PayPal credentials for the specific restaurant from the database
    $paypalCredentials = PaimentRestaurant::where('restaurant_id', $client->id)
    ->where('paiment_id', $paymentMethodId)
    ->first();

    if (!$paypalCredentials) {
        // Handle the case where credentials for the restaurant were not found
        return response()->json(['error' => 'Restaurant not found or credentials missing'], 404);
    }
	//dd($paypalCredentials);
    $cart = session()->get('cart', []);
    $host = request()->getHost();
    $subdomain = explode('.', $host)[0];

    // Calculate the total price of the items in the cart
    $totalPrice = $this->calculateTotalPrice($cart);

    try {
        // Set the Stripe secret API key from your environment variables
   //   \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
		  \Stripe\Stripe::setApiKey($paypalCredentials->client_secret);
      // dd(env('STRIPE_KEY'));
        // Create a Stripe charge
        \Stripe\Charge::create([
            "amount" => $totalPrice * 100,  // Amount in cents
            "currency" => "eur",
            "source" => $request->stripeToken,
            "description" => "Paiement Sur Salade & Cie"
        ]);

        // Payment was successful
        return response()->json(['message' => 'Payment successful'], 200);
		dd(response());
    } catch (\Exception $e) {
				

        // Payment failed
        return response()->json(['message' => 'Payment failed: ' . $e->getMessage()], 400);
    }
}

	 private function calculateTotalPrice($cart)
    {
        $totalPrice = 0;

        foreach ($cart as $cartItem) {
            if (isset($cartItem['price']) && is_numeric($cartItem['price'])) {
                $totalPrice += $cartItem['price'];
            }
        }

        return $totalPrice;
    }
}
