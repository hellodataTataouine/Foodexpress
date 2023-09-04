<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {

        {
            // Assuming you've retrieved the restaurant ID associated with the order
            $restaurantId = $request->input('restaurant_id'); // Adjust this based on your actual request data
    
            // Retrieve the PayPal credentials for the specific restaurant from the database
            $paypalCredentials = RestaurantPaypalCredentials::where('restaurant_id', $restaurantId)->first();
    
            if (!$paypalCredentials) {
                // Handle the case where credentials for the restaurant were not found
                return response()->json(['error' => 'Restaurant not found or credentials missing'], 404);
            }
    
            // Configure PayPal SDK with the retrieved credentials
            $paypal = new PayPalHttpClient(new ProductionEnvironment($paypalCredentials->client_id, $paypalCredentials->client_secret));
    



            
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
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
