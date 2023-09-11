<?php

namespace App\Http\Controllers;
use App\Models\ClientRestaurat;
use App\Models\CommandProduct;
use App\Models\CommandProductOptions;
use App\Models\PaimentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

use App\Models\ProduitsRestaurants;
use App\Models\CartOptionProductSelected;
use App\Models\CartDetails;
use App\Models\CarteUser;
use App\Models\PaimentRestaurant;
use App\Models\LivraisonRestaurant;
use App\Models\Command;
use App\Models\OptionsRestaurant;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Session;    


class CommandController extends Controller
{
   // Handle adding items to the cart (commands) and save in session
   public function addToCart(Request $request)
   {
    $cartItem = $request->input('cartItem');
    
    $productId = $cartItem['id'];
    $productName = $cartItem['name'];
    $productImage = $cartItem['image'];
    $productPrice = $cartItem['price'];
    $productUnityPrice = $cartItem['unityPrice'];
    $productQuantity= $cartItem['quantity'];
    $customizationOptions = isset($cartItem['options']) ? $cartItem['options'] : null; // An array containing selected options and their quantities

    if (!isset($cartItem['options'])) {
        $cartItem['options'] = []; // Set 'options' to an empty array if not already set
    }
//    $customizationOptions = $cartItem['options']; // An array containing selected options and their quantities

     // Check if a command with the same product and options already exists in the session
    $cart = session()->get('cart', []);
  

       $cartItem = [
           'id' => $productId,
           'name' => $productName,
           'image' => $productImage,
           'price' => $productPrice,
           'unityPrice' => $productUnityPrice,
           'quantity' => $productQuantity,
          
          
         //  'options' => $customizationOptions
       ];
        // Add customization options to the cart item data if available
    if ($customizationOptions !== null) {
        $cartItem['options'] = $customizationOptions;
    // Log the selected options to the console
    
    }else{ $cartItem['options'] = [];}

       $cart[] = $cartItem;
    
       // Save the cart data back to the session
       session()->put('cart', $cart);

       return response()->json(['success' => true, 'message' => 'Product added to cart successfully']);
   }

   public function fetchCart(Request $request)
   {
       $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
       $cartItems = Session::get('cart', []);
       $cartItemCount = count($cartItems);
       $totalPrice = 0;
       foreach ($cartItems as $item) {
           $totalPrice += $item['price'] ;
       }
       return response()->json(compact('cartItems', 'cartItemCount', 'subdomain','totalPrice'));
   }

   public function checkout(Request $request)
   {
       $sub = $request->getHost();
       $subdomainVerif = preg_replace('/:\d+$/', '', $sub).':8000'; 
       $client = Client::where('url_platform', $subdomainVerif)->firstOrFail();
       $clientId = $client->id;
      // $subdomain = $client->url_platform;
       $subdomain = explode('.', $sub)[0];
       $cartItems = Session::get('cart', []);
       $livraisons = LivraisonRestaurant::where('restaurant_id', $clientId)->get();
       $paiments = PaimentRestaurant::where('restaurant_id', $clientId)->get();
       $cart = session()->get('cart', []);
       $totalPrice = 0;
       foreach ($cartItems as $item) {
           $totalPrice += $item['price'] ;
       }
       return view('client.checkout',compact('cartItems','subdomain','client','livraisons','paiments','cart', 'totalPrice'));
      
   }


   public function store(Request $request)
   {


   
        $cartItems = session('cart', []);
        $totalPrice = 0;
       $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
       $client = Client::where('url_platform', $subdomain)->firstOrFail();
       $restaurantId = $client->id;
       
       foreach ($cartItems as $cartItem) {
        // Ensure 'price' and 'quantity' keys exist and are numeric
        if (isset($cartItem['price'])  && is_numeric($cartItem['price']) ) {
            // Perform the calculation and add to totalPrice
            $totalPrice += $cartItem['price'];
            $TVA = ($totalPrice * 20) / 100;
            $HT = $totalPrice - $TVA ;

        } else {
            // Handle the case where 'price' or 'quantity' is missing or not numeric
            // You can log an error or add debugging statements here to investigate the issue.
        }
    }


    $deliveryMethodId = $request->input('delivery_method');
    $paymentMethodId = $request->input('payment_method');

    //check if user is loggedin
    if (auth()->guard('clientRestaurant')->check()){
        $userId = auth()->guard('clientRestaurant')->id();
        if ($userId) {
            $Userloggedin = ClientRestaurat::findOrFail($userId);
$Command = new Command;
$Command->user_id = $userId;
$Command->restaurant_id = $client->id;
$Command->prix_total = $totalPrice;
$Command->prix_TVA = $TVA;
$Command->prix_HT = $HT;
$Command->methode_paiement = $paymentMethodId;
$Command->mode_livraison = $deliveryMethodId;
$Command->statut ='Nouveau';
$Command->Clientfirstname =$Userloggedin->FirstName;
$Command->clientlastname =$Userloggedin->LastName;
$Command->clientPostalcode =$Userloggedin->codepostal;
$Command->clientAdresse =$Userloggedin->Address;
$Command->clientVille =$Userloggedin->ville;
$Command->clientNum1 =$Userloggedin->phoneNum1;
$Command->clientNum2 =$Userloggedin->phoneNum2;
 $Command->clientEmail =$Userloggedin->email;

$Command->save();




        }


  }
else{
      // Check if the "Créer un compte" checkbox is checked
    $creerUnCompteChecked = $request->has('creer_un_compte');
    $email = $request->input('email');
$password = $request->input('password');

if ($creerUnCompteChecked && !empty($email) && !empty($password)) {
        $basicUser = new ClientRestaurat;
       
        $basicUser->FirstName = $request->nom;
        $basicUser->LastName = $request->prenom;
        $basicUser->ville = $request->ville;
        $basicUser->Address = $request->addresse;
        $basicUser->codepostal = $request->codePostal;
        $basicUser->phoneNum1 = $request->num1;
        $basicUser->phoneNum2 = $request->num2;
        $basicUser->email = $request->email;
        $basicUser->password = Hash::make($request->password);
        $basicUser->restaurant_id = $restaurantId; // Set the appropriate restaurantId here


        $basicUser->save();
 
        // Log in the newly registered user
        auth('clientRestaurant')->login($basicUser);

    } 
      
       // Insert into cart_user table
       $Command = new Command;
       $Command->user_id = Auth::id();
       $Command->restaurant_id = $client->id;
       $Command->prix_total = $totalPrice;
       $Command->prix_TVA = $TVA;
       $Command->prix_HT = $HT;
       $Command->methode_paiement = $paymentMethodId;
       $Command->mode_livraison = $deliveryMethodId;
       $Command->statut ='Nouveau';
       $Command->Clientfirstname =$request->input('nom');
       $Command->clientlastname =$request->input('prenom');
       $Command->clientPostalcode =$request->input('codePostal');
       $Command->clientAdresse =$request->input('addresse');
       $Command->clientVille =$request->input('ville');
       $Command->clientNum1 =$request->input('num1');
       $Command->clientNum2 =$request->input('num2');
      // $Command->clientEmail =$request->input('email');

       $Command->save();

}
    
       
// Attach famille options to the produit
      
foreach ($cartItems as $cartItem) {
    
     $CartDetails = new CartDetails;
     $CartDetails->cart_id = $Command->id;
     $CartDetails->product_id = $cartItem['id'];
     $CartDetails->qte_produit =$cartItem['quantity'];
     $CartDetails->prixtotal_produit =$cartItem['price'];
     $CartDetails->optionsdetails = json_encode($cartItem['options']); // Convert
    // $CartDetails->cart_option_product_selected_id =  $cartOptionProductSelected->id;
   
    $CartDetails->save();
    $cart = session()->get('cart', []);
}

$PaymentMethode = PaimentMethod::findOrFail($paymentMethodId);
if($PaymentMethode != null){
    
if($PaymentMethode->type_methode == 'PayPal'){
    $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
    //dd($subdomain);
    $route = route('make.payment', ['subdomain' => $subdomain]);
    //dd($route);
    return redirect()->route('make.payment', ['subdomain' => $subdomain]);
  
    //$this->handlePayment($request);

}
else {  
// Clear the cart sessions
$request->session()->forget('cart');
return view('client.checkout_success', compact('subdomain', 'client','cart'));
}
     
}  
}




//Handle Payment 
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
    'currency'       => 'USD',
    'billing_type'   => 'MerchantInitiatedBilling',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => true, // Validate SSL when creating api client.

 
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
                "value" => $totalPrice, // Set the total price dynamically
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







    public function registerAndCheckout(Request $request)
    {

        $totalPrice = 0;
        $subdomain = $request->getHost();
        $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
        $client = Client::where('url_platform', $subdomain)->firstOrFail();
        $restaurantId = $client->id;
        $deliveryMethodId = $request->input('delivery_method');
        $paymentMethodId = $request->input('payment_method');
        // Validate the registration form data
       /* $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:basic_users,email',
            'password' => 'required|min:8|confirmed',
        ]);*/
 
        // Create a new user with the provided registration data
        $basicUser = new ClientRestaurat;
       
        $basicUser->FirstName = $request->name;
        $basicUser->LastName = $request->prenom;
        $basicUser->ville = $request->ville;
        $basicUser->Address = $request->addresse;
        $basicUser->codepostal = $request->codePostal;
        $basicUser->phoneNum1 = $request->phone;
        $basicUser->phoneNum2 = $request->phone2;
        $basicUser->email = $request->email;
        $basicUser->password = Hash::make($request->password);
        $basicUser->restaurant_id = $restaurantId; // Set the appropriate restaurantId here


        $basicUser->save();
 
        // Log in the newly registered user
        auth()->login($basicUser);
 
        // Get the cart items from the session
        $cartItems = session('cart', []);
 
       // Insert cart details into the database
     
       foreach ($cartItems as $cartItem) {
        // Ensure 'price' and 'quantity' keys exist and are numeric
        if (isset($cartItem['price']) && isset($cartItem['quantity']) && is_numeric($cartItem['price']) && is_numeric($cartItem['quantity'])) {
            // Perform the calculation and add to totalPrice
            $totalPrice += $cartItem['price'];

        } else {
            // Handle the case where 'price' or 'quantity' is missing or not numeric
            // You can log an error or add debugging statements here to investigate the issue.
        }
$TVA = ($totalPrice * 20) / 100;
$HT = $totalPrice - $TVA ;

    }
   
    $ClientRestaurant = ClientRestaurat::findOrFail(Auth::id());
       // Insert into cart_user table
       $Command = new Command;
       $Command->user_id = Auth::id();
       $Command->restaurant_id = $client->id;
       $Command->prix_total = $totalPrice;
       $Command->prix_TVA = $TVA;
       $Command->prix_HT = $HT;
       $Command->methode_paiement = $paymentMethodId;
       $Command->mode_livraison = $deliveryMethodId;
       $Command->statut ='Nouveau';
       $Command->Clientfirstname =$ClientRestaurant->FirstName;
       $Command->clientlastname =$ClientRestaurant->LastName;
       $Command->clientAdresse =$ClientRestaurant->Address;
       $Command->clientPostalcode =$ClientRestaurant->codepostal;
       $Command->clientVille =$ClientRestaurant->ville;
       $Command->clientNum1 =$ClientRestaurant->phoneNum1;
       $Command->clientNum2 =$ClientRestaurant->phoneNum2;
       $Command->clientEmail =$ClientRestaurant->email;

       $Command->save();


    
       
// Attach famille options to the produit
      
foreach ($cartItems as $cartItem) {
    
     $CartDetails = new CartDetails;
     $CartDetails->cart_id = $Command->id;
     $CartDetails->product_id = $cartItem['id'];
     $CartDetails->qte_produit =$cartItem['quantity'];
     $CartDetails->optionsdetails =$cartItem['options'];
    // $CartDetails->cart_option_product_selected_id =  $cartOptionProductSelected->id;
   
   
   
    $CartDetails->save();
  
    $cart = session()->get('cart', []);

}
       
        // Clear the cart session
        $request->session()->forget('cart');
 
        // Redirect the user to a success page or any other desired page
        return view('client.checkout_success', compact('subdomain', 'client'));
    }
   //show panier 
   public function getCartItems()
    {

        
    }
   // Display the cart for confirmation
   public function showCartForConfirmation()
   {
       // Fetch cart data from the session
       $cartItems = session()->get('cart', []);

       return view('restaurant.confirmation', compact('cartItems'));
   }
   

   public function removeCartItem(Request $request)
   {
    $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
    $productId = $request->input('productId');
        
    // Assuming you are storing cart data in the session
    $cart = session()->get('cart', []);

    // Find the index of the item to remove in the cart array
    $itemIndex = array_search($productId, array_column($cart, 'id'));

    if ($itemIndex !== false) {
        // Remove the item from the cart array
        array_splice($cart, $itemIndex, 1);

        // Recalculate total price
        $totalPrice = 0;
        foreach ($cart as $cartItem) {
            // Ensure 'price' and 'quantity' keys exist and are numeric
            if (isset($cartItem['price'])  && is_numeric($cartItem['price']) ) {
                // Perform the calculation and add to totalPrice
                $totalPrice += $cartItem['price'];
    
            } }
        // Update the cart in the session
        session()->put('cart', $cart);
        $cartItemCount = count($cart);
        return response()->json([
            'cartItems' => $cart,
            'totalPrice' => $totalPrice,
            'subdomain' => $subdomain,
            'cartItemCount' => $cartItemCount,
            
        ]);
    } else {
        return response()->json([
            'error' => 'Item not found in the cart.',
        ], 404);
    }
   }
 

   public function updateQuantity(Request $request)
   {
       $productId = $request->input('productId');
       $quantity = $request->input('quantity');

       // Get the current cart data from the session or database
       $cart = session()->get('cart', []);

       // Find the item in the cart with the matching productId
       $itemToUpdate = null;
       foreach ($cart as &$cartItem) {
           if ($cartItem['id'] == $productId) {
               $itemToUpdate = &$cartItem;
               break;
           }
       }

       if ($itemToUpdate) {
           // Update the quantity of the item in the cart
           $itemToUpdate['quantity'] = $quantity;
           $itemToUpdate['price'] = $quantity * $itemToUpdate['unityPrice'];

           // Update the cart data in the session or database
           session()->put('cart', $cart);
           $totalPrice = 0;
           foreach ($cart as $cartItem) {
               // Ensure 'price' and 'quantity' keys exist and are numeric
               if (isset($cartItem['price'])  && is_numeric($cartItem['price']) ) {
                   // Perform the calculation and add to totalPrice
                   $totalPrice += $cartItem['price'];
       
               } }
           return response()->json([
               'message' => 'Quantity updated successfully',
               
                
                'totalPrice' => $totalPrice,
                
               
                
           
           ]);
       } else {
           return response()->json([
               'error' => 'Item not found in the cart.',
           ], 404);
       }
   }


   //historic commandes 
   public function commandes(Request $request)
   {
       $subdomain = $request->root(); // Get the root URL (including subdomain) from the request
       $parsedUrl = parse_url($subdomain); // Parse the URL to extract the parts
       $subdomain = $parsedUrl['host'].':8000';
       $client = Client::where('url_platform', $subdomain)->firstOrFail();
       // Get the ID of the logged-in user
       $userId = auth()->guard('clientRestaurant')->id();
       if ($userId) {
     
       // Fetch all commandes of the logged-in user from the database
       $commandes = Command::where('user_id', $userId)->orderByDesc('id')->get();
       $cart = session()->get('cart', []);
       // Pass the list of commandes to the view
       return view('client.commandes', compact('commandes','client','subdomain','cart'));
   }
}

}
