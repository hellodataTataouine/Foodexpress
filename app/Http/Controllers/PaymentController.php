<?php

namespace App\Http\Controllers;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use App\Models\PaimentMethod;
use App\Models\LivraisonRestaurant;
use App\Models\Client;
use App\Models\PaimentRestaurant;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use App\Notifications\FirebaseNotificationNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FirebaseNotification;
class PaymentController extends Controller
{
   public function handlePayment(Request $request, $subdomain, $paymentMethodId)
{
//dd($paymentMethodId);
    $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain);
    $client = Client::where('url_platform', $subdomain)->firstOrFail();

    // Retrieve the PayPal credentials for the specific restaurant from the database
    $paypalCredentials = PaimentRestaurant::where('restaurant_id', $client->id)
    ->where('paiment_id', $paymentMethodId)
    ->first();

    if (!$paypalCredentials) {
        // Handle the case where credentials for the restaurant were not found
        return response()->json(['error' => 'Restaurant not found or credentials missing'], 404);
    }
//dd($paypalCredentials);
    // Calculate the total price, TVA, and HT based on your order logic
	   // Set the necessary headers to allow your server to make the request.

    $cartItems = session('cart', []);
    $totalPrice = 0;
    $subTotal = 0; // Subtotal without taxes
    // Calculate total price and subtotal dynamically based on your cart items
    foreach ($cartItems as $cartItem) {
        if (isset($cartItem['price']) && is_numeric($cartItem['price'])) {
            $totalPrice += $cartItem['price'];
            // Update the subtotal calculation as needed based on your logic
            // For example, if you have tax calculations, add them here
        }
    }
    if($totalPrice != 0){
		
    // Create an instance of PayPalClient
    $provider = new PayPalClient;
    $config = [
        'mode'    => 'live',
        'live' => [
            'client_id'         => $paypalCredentials->client_id, // Use the correct attribute name
            'client_secret'     => $paypalCredentials->client_secret, // Use the correct attribute name
        ],
        'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
        'currency'       => env('PAYPAL_CURRENCY', 'EUR'),
        'billing_type'   => 'MerchantInitiatedBilling',
        'notify_url'     => '', // Change this accordingly for your application.
        'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
        'validate_ssl'   => true, // Validate SSL when creating api client.
         'allowed_payment_method' => ['INSTANT_FUNDING_SOURCE', 'CREDIT_CARD'],
        $payment_options =  [
             'allowed_payment_method' => ['INSTANT_FUNDING_SOURCE', 'CREDIT_CARD'],
			
        ],
    ];

$provider->setApiCredentials($config);
// Set the PayPal API credentials using the credentials from the database

// Retrieve the PayPal access token
$paypalToken = $provider->getAccessToken();
 $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
	
	
    	//dd($subdomain);
    // Configure PayPal SDK with the retrieved credentials
    $response = $provider->createOrder([
		
        "intent" => "CAPTURE",
        "application_context" => [
            "return_url" => route('success.payment', ['subdomain' => $subdomain]),
            "cancel_url" => route('cancel.payment', ['subdomain' => $subdomain]),
        ],
        "purchase_units" => [
            0 => [
                "amount" => [
                    "currency_code" => "EUR", // Set the currency dynamically if needed
                    "value" => number_format($totalPrice, 2), // Set the total price dynamically
                ],
            ],
        ],
		 "payment_method" => "credit_card",
    ]);
//dd($response);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment', ['subdomain' => $subdomain])
                ->with('error', 'Something went wrong.');
               
        } else {
            return redirect()
                ->route('create.payment', ['subdomain' => $subdomain])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    }

    
    public function paymentCancel(Request $request)
    {	  $cartItems = session('cart', []);
	 $cart = session()->get('cart', []);
		  $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
		  $client = Client::where('url_platform', $subdomain)->firstOrFail();
       //$request->session()->forget('cart');
	  $livraisons = LivraisonRestaurant::where('restaurant_id', $client->id)->get();
       $paiments = PaimentRestaurant::where('restaurant_id', $client->id)->get();
 $totalPrice = 0;
       foreach ($cartItems as $item) {
           $totalPrice += $item['price'] ;
       }
	    $totalPrice = number_format($totalPrice, 2);
return view('client.checkout', compact('subdomain', 'client','cart','livraisons','paiments','cartItems','totalPrice'));  
    }

	
	
	
	public function paymentSuccess(Request $request)
    {
		 $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
	
		
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
			
            return redirect()
                ->route('createTransaction' , ['subdomain' => $subdomain]);
                
        } else {
            return redirect()
                ->route('createTransaction', ['subdomain' => $subdomain])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
         $cartItems = Session::get('cart', []);
		$totalPrice = 0;
       foreach ($cartItems as $item) {
           $totalPrice += $item['price'] ;
       }
	    $totalPrice = number_format($totalPrice, 2);
          return view('client.checkout',compact('totalPrice'));
           
    }
	
	 public function createTransaction(Request $request)
    {
		 $cart = session()->get('cart', []);
		  $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
		  $client = Client::where('url_platform', $subdomain)->firstOrFail();
		 $restaurantId = $client->id;
		 $Command = session('command');
		 
       
    $cartDetailsArray = session('cartDetails');
    $data = session('data');
    // Save the Command to the database
    $Command->save();

    // Iterate through the CartDetails array and save each one
    foreach ($cartDetailsArray as $cartDetail) {
        $cartDetail->cart_id = $Command->id; // Set the cart_id if needed
        $cartDetail->save();
    }
		 $data['commandId'] = $Command->id;
		 // Define the email subject
$subject = 'Réception de commande';
// Store the email in the session
$userId = auth()->guard('clientRestaurant')->id();
	
        if ($userId) {
// Send the email using the Blade view
Mail::send('order_confirmation', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['clientEmail']);
});
	Mail::send('order_confirmation_restaurant', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['email']);
});
		}
		 else{
			 Mail::send('order_confirmation_restaurant', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['email']);
});
		 }
		 //Notification
$firebaseToken = Imei::where('restaurant_id', $restaurantId)
    ->whereNotNull('fcm_token')
    ->pluck('fcm_token')
    ->all();            
        $SERVER_API_KEY = env('FCM_SERVER_KEY');
    
//dd($devices);
// Create the notification instance


try {
    // Send the notification to all the devices associated with the client
   // Notification::send($token, $notification)->notify($notification);
   $data = [
    "registration_ids" => $firebaseToken,
    "notification" => [
        "title" => "Nouvelle Commande",
        "body" => "Ticket N°: " . $Command->id . "\n" . $Command->Clientfirstname . ' ' . $Command->clientlastname,
    ]
];


$dataString = json_encode($data);

$headers = [
    'Authorization: key=' . $SERVER_API_KEY,
    'Content-Type: application/json',
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
         
$response = curl_exec($ch);
//dd($response);
    // Notification sent successfully
  //  Session::flash('success', 'Notification sent successfully.');
} catch (\Exception $e) {
    // Handle the exception and show an error message
    //Session::flash('error', 'Failed to send notification: ' . $e->getMessage());
}
		 session()->forget('cartDetails');
	session()->forget('command');
session()->forget('data');
	session()->forget('cart');
     //  $request->session()->forget('cart');
return redirect()
    ->route('client.checkout.store', ['subdomain' => $subdomain ,'statut' => 'Payé']);
                
//return view('client.checkout_success', compact('subdomain', 'client','cart'));
    }
	
	
	
}
