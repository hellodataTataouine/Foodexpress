<?php

namespace App\Http\Controllers;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

use App\Models\Client;
use App\Models\PaimentRestaurant;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {

        $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain) . ':8000';
    $client = Client::where('url_platform', $subdomain)->firstOrFail();

    // Retrieve the PayPal credentials for the specific restaurant from the database
    $paypalCredentials = PaimentRestaurant::where('restaurant_id', $client->id)->first();

    if (!$paypalCredentials) {
        // Handle the case where credentials for the restaurant were not found
        return response()->json(['error' => 'Restaurant not found or credentials missing'], 404);
    }
//dd($paypalCredentials);
    // Calculate the total price, TVA, and HT based on your order logic
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
        'mode'    => 'sandbox',
        'sandbox' => [
            'client_id'         => $paypalCredentials->client_id, // Use the correct attribute name
            'client_secret'     => $paypalCredentials->client_secret, // Use the correct attribute name
        ],
        'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
        'currency'       => env('PAYPAL_CURRENCY', 'USD'),
        'billing_type'   => 'MerchantInitiatedBilling',
        'notify_url'     => '', // Change this accordingly for your application.
        'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
        'validate_ssl'   => true, // Validate SSL when creating api client.

        $payment_options =  [
            'allowed_payment_method' => 'INSTANT_FUNDING_SOURCE',
        ],
    ];
//dd($config);
$provider->setApiCredentials($config);
// Set the PayPal API credentials using the credentials from the database

// Retrieve the PayPal access token
$paypalToken = $provider->getAccessToken();

    
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
                    "currency_code" => "USD", // Set the currency dynamically if needed
                    "value" => number_format($totalPrice, 2), // Set the total price dynamically
                ],
            ],
        ],
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

    
    public function paymentCancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error',  'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('create.payment')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
