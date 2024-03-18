<?php

namespace App\Http\Controllers;
use App\Models\ClientRestaurat;
use App\Models\CommandProduct;
use App\Models\CommandProductOptions;
use App\Models\Imei;
use App\Models\PaimentMethod;
use App\Models\User;
use App\Notifications\FirebaseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
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
use App\Notifications\FirebaseNotificationNotification;
use Illuminate\Support\Facades\Notification;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


use Illuminate\Support\Facades\Mail;

   

class CommandController extends Controller
{
	public function cancelCommande($id)
    {
        $commande = Command::findOrFail($id);
        if ($commande->statut === 'Nouveau') {
            $commande->update(['statut' => 'Annulée']);
        }
        return redirect()->route('client.commandes');
    }

	
   public function addToCart(Request $request)
   {
    $cartItem = $request->input('cartItem');
    
    $productId = $cartItem['id'];
	   $productItem= $cartItem['idItem'];
    $productName = $cartItem['name'];
    $productImage = $cartItem['image'];
    $productPrice = $cartItem['price'];
    $productUnityPrice = $cartItem['unityPrice'];
    $productQuantity= $cartItem['quantity'];
    $customizationOptions = isset($cartItem['options']) ? $cartItem['options'] : null; 

    if (!isset($cartItem['options'])) {
        $cartItem['options'] = []; 
    }
//    $customizationOptions = $cartItem['options']; // An array containing selected options and their quantities

    $cart = session()->get('cart', []);
  

       $cartItem = [
           'id' => $productId,
		   'idItem' => $productItem,
           'name' => $productName,
           'image' => $productImage,
           'price' => $productPrice,
           'unityPrice' => $productUnityPrice,
           'quantity' => $productQuantity,
          
          
         //  'options' => $customizationOptions
       ];
    if ($customizationOptions !== null) {
        $cartItem['options'] = $customizationOptions;
    
    }else{ $cartItem['options'] = [];}

       $cart[] = $cartItem;
    
       session()->put('cart', $cart);

       return response()->json(['success' => true, 'message' => 'Produit  a été ajouté avec succès']);
   }
public function editCart(Request $request)
{
    $cartItem = $request->input('cartItem');
 
    $idItem = $cartItem['idItem'];
    $productQuantity = $cartItem['quantity'];
	 $productPrice = $cartItem['price'];
    $customizationOptions = isset($cartItem['options']) ? $cartItem['options'] : null;

    $cart = session()->get('cart', []);

    $itemExists = false;

    // Find the cart item to edit by matching the product ID
    foreach ($cart as &$item) {
        if ($item['idItem'] == $idItem) {
            // Update the quantity
            $item['quantity'] = $productQuantity;
             $item['price'] = $productPrice;
            // Update customization options if provided
            if ($customizationOptions !== null) {
                $item['options'] = $customizationOptions;
            }

            $itemExists = true;
            break; // Exit the loop once the item is updated
        }
    }

    if (!$itemExists) {
        // Item doesn't exist, so add a new item to the cart
        $cartItem['options'] = $customizationOptions ?? [];
        $cart[] = $cartItem;
    }

    session()->put('cart', $cart);

    return response()->json(['success' => true, 'message' => 'Produit a été modifié avec succès']);
}

   public function fetchCart(Request $request)
   {
       $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
       $cartItems = Session::get('cart', []);
       $cartItemCount = count($cartItems);
       $totalPrice = 0;
       foreach ($cartItems as $item) {
           $totalPrice += $item['price'] ;
       }
	    $totalPrice = number_format($totalPrice, 2);
       return response()->json(compact('cartItems', 'cartItemCount', 'subdomain','totalPrice'));
   }

   public function checkout(Request $request)
   {
	    if (auth()->guard('clientRestaurant')->check()){
            $userId = auth()->guard('clientRestaurant')->id();
           if ($userId) {
		   $clientRestaurant = ClientRestaurat::findOrFail($userId);
		   }
			
			 } else{
			 $clientRestaurant = null;
		 }
       $sub = $request->getHost();
       $subdomainVerif = preg_replace('/:\d+$/', '', $sub); 
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
	    $totalPrice = number_format($totalPrice, 2);
       return view('client.checkout',compact('cartItems','subdomain','client','livraisons','paiments','cart', 'totalPrice', 'clientRestaurant'));
      
   }


   public function store(Request $request)
   {
	 session::start();
	  // dd($request);
	     $cart = session()->get('cart', []);
	   $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
        $cartItems = session('cart', []);
	    if($cartItems){
	 // dd( $cartItems);
        $totalPrice = 0;
       
       $client = Client::where('url_platform', $subdomain)->firstOrFail();
			$clientId = $client->id;
		$livraisons = LivraisonRestaurant::where('restaurant_id', $clientId)->get();

       $restaurantId = $client->id;
	   $user = User::findOrFail($client->user_id);
       
       foreach ($cartItems as $cartItem) {
        if (isset($cartItem['price'])  && is_numeric($cartItem['price']) ) {
            $totalPrice += $cartItem['price'];
          

        } else {
        }
    }
	    
 $totalPrice = number_format($totalPrice, 2);
 $TVA = ($totalPrice * 20) / 100;
            $HT = $totalPrice - $TVA ;
	   //dd($request->input('delivery_method'));
    $deliveryMethodId = $request->input('delivery_method');
	   
    $paymentMethodId = $request->input('payment_method');
	   
$deliveryTime = $request->has('delivery_time') ? $request->input('delivery_time') : '';

$PaymentMethode = PaimentMethod::findOrFail($paymentMethodId);
	 
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
$Command->Clientfirstname =$request->input('nom');
$Command->clientlastname =$request->input('prenom');
$Command->clientPostalcode =$request->input('codePostal');
$Command->clientAdresse =$request->input('adresse');
$Command->clientVille =$request->input('ville');
$Command->clientNum1 =$request->input('num1');
$Command->clientNum2 =$request->input('num2');		
/*$Command->Clientfirstname =$Userloggedin->FirstName;
$Command->clientlastname =$Userloggedin->LastName;
$Command->clientPostalcode =$Userloggedin->codepostal;
$Command->clientAdresse =$Userloggedin->Address;
$Command->clientVille =$Userloggedin->ville;
$Command->clientNum1 =$Userloggedin->phoneNum1;
$Command->clientNum2 =$Userloggedin->phoneNum2;*/		
$Command->clientEmail =$Userloggedin->email;
$Command->delivery_time = $deliveryTime; 
//$Command->save();
			
			
		$basicUser = ClientRestaurat::find($userId);
       
        $basicUser->FirstName = $request->nom;
        $basicUser->LastName = $request->prenom;
        $basicUser->ville = $request->ville;
        $basicUser->Address = $request->adresse;
        $basicUser->codepostal = $request->codePostal;
        $basicUser->phoneNum1 = $request->num1;
        $basicUser->phoneNum2 = $request->num2;
        
        $basicUser->save();
			
			
			
			$cartDetailsArray = [];
	foreach ($cartItems as $cartItem) {
    $cartDetail = new CartDetails;
    $cartDetail->cart_id = $Command->id;
    $cartDetail->product_id = $cartItem['id'];
    $cartDetail->qte_produit = $cartItem['quantity'];
    $cartDetail->prixtotal_produit = $cartItem['price'];

   if(($cartItem['options'] != []))
     $cartDetail->optionsdetails = $cartItem['options'];
    else
    $cartDetail->optionsdetails = "";
	

    // Save each CartDetails to the array
    $cartDetailsArray[] = $cartDetail;
}
			
// confirmation Email

// Set the email in the session
$email= $user->email;
			
$data = [
    'clientFirstName' => $Userloggedin->FirstName,
    'clientLastName' => $Userloggedin->LastName,
	'clientNum1' => $Userloggedin->phoneNum1,
	'clientAdresse' => $Userloggedin->Address,
    'commandId' => $Command->id,
    'currentDateTime' => now()->format('d/m/Y H:i'),
    'cartItems' => $cartItems,
    'totalPrice' => $totalPrice,
    'clientEmail' => $Userloggedin->email,
    'email' => $email, // Use the email from the session-

];
			
			
session([
    'command' => $Command,
   'cartDetails' => $cartDetailsArray,
	'data' => $data,
]);
/*
// Define the email subject
$subject = 'Confirmation de commande';
// Store the email in the session

// Send the email using the Blade view
Mail::send('order_confirmation', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['clientEmail']);
});
			Mail::send('order_confirmation_restaurant', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['email']);
});
			
	*/		
			
		if($PaymentMethode->type_methode == 'PayPal'){
    $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
    //dd($subdomain);
    
    //dd($route);
    return redirect()->route('make.payment', ['subdomain' => $subdomain, 'paymentMethodId' => $paymentMethodId]);
   

}
			else{
			
					 $Command = session('command');
     
    $cartDetailsArray = session('cartDetails');
  
    // Save the Command to the database
    $Command->save();
 $data['commandId'] = $Command->id;
    // Iterate through the CartDetails array and save each one
    foreach ($cartDetailsArray as $cartDetail) {
        $cartDetail->cart_id = $Command->id; // Set the cart_id if needed
        $cartDetail->save();
    }
			// Define the email subject
$subject = 'Confirmation de commande';
// Store the email in the session

// Send the email using the Blade view
Mail::send('order_confirmation', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['clientEmail']);
});
			Mail::send('order_confirmation_restaurant', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['email']);
});	
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
			}
        }
					
  }
	   
else{
	//dd($payment);
    $creerUnCompteChecked = $request->has('creer_un_compte');
	//dd($creerUnCompteChecked);
    $email = $request->input('email');
$password = $request->input('password');

if ($creerUnCompteChecked && !empty($email) && !empty($password)) {
        $basicUser = new ClientRestaurat;
       
        $basicUser->FirstName = $request->nom;
        $basicUser->LastName = $request->prenom;
        $basicUser->ville = $request->ville;
        $basicUser->Address = $request->adresse;
        $basicUser->codepostal = $request->codePostal;
        $basicUser->phoneNum1 = $request->num1;
        $basicUser->phoneNum2 = $request->num2;
        $basicUser->email = $request->email;
        $basicUser->password = Hash::make($request->password);
        $basicUser->restaurant_id = $restaurantId; 


        $basicUser->save();
	$data = [
            'clientFirstName' => $basicUser->FirstName,
            'clientLastName' => $basicUser->LastName,
            'clientNum1' => $basicUser->phoneNum1,
            'clientAdresse' => $basicUser->Address,
            'email' => $basicUser->email,
        ];

        Mail::send('registration_confirmation', $data, function ($message) use ($data) {
            $message->subject('Confirmation d\'inscription')
                    ->to($data['email']);
        });
	
 
        // Log in the newly registered user
        auth('clientRestaurant')->login($basicUser);

    } 
    
    

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
       $Command->clientAdresse =$request->input('adresse');
       $Command->clientVille =$request->input('ville');
       $Command->clientNum1 =$request->input('num1');
       $Command->clientNum2 =$request->input('num2');
      // $Command->clientEmail =$request->input('email');
	  $Command->delivery_time = $deliveryTime; // Save the selected delivery time
		
$cartDetailsArray = [];
	foreach ($cartItems as $cartItem) {
    $cartDetail = new CartDetails;
    $cartDetail->cart_id = $Command->id;
    $cartDetail->product_id = $cartItem['id'];
    $cartDetail->qte_produit = $cartItem['quantity'];
    $cartDetail->prixtotal_produit = $cartItem['price'];
//dd($cartItem['options']);
   if(($cartItem['options'] != []))
     $cartDetail->optionsdetails = $cartItem['options'];
    else
    $cartDetail->optionsdetails = "";


    // Save each CartDetails to the array
    $cartDetailsArray[] = $cartDetail;
}
	
$email= $user->email;	
//$email = 'firas.saafi96@gmail.com'; 
$data = [
    'clientFirstName' => $Command->Clientfirstname,
    'clientLastName' => $Command->clientlastname,
	'clientNum1' => $Command->clientNum1,
	'clientAdresse' => $Command->clientAdresse,
    'commandId' => $Command->id,
    'currentDateTime' => now()->format('d/m/Y H:i'),
    'cartItems' => $cartItems,
    'totalPrice' => $totalPrice,
    'email' => $email,
	
];
	session([
    'command' => $Command,
   'cartDetails' => $cartDetailsArray,
	'data' => $data,
]);
	
/*
// Define the email subject
$subject = 'Confirmation de commande';
// Store the email in the session

			Mail::send('order_confirmation_restaurant', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['email']);
});*/
      // $Command->save();
		if($PaymentMethode->type_methode == 'PayPal'){
    $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
    //dd($subdomain);
    
    //dd($route);
    return redirect()->route('make.payment', ['subdomain' => $subdomain, 'paymentMethodId' => $paymentMethodId]);
   

}
			else{
			
					 $Command = session('command');
     
    $cartDetailsArray = session('cartDetails');
  
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


			Mail::send('order_confirmation_restaurant', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['email']);
});	
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
			}			

}
    
  
	

//Paiement
 
// Clear the cart sessions

$cartItemCount = count($cart);

return view('client.checkout_success', compact('subdomain', 'client','cart', 'cartItemCount', 'livraisons'));

  
		} else{
			  $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
		
	  return redirect()->route('client.products.index', ['subdomain' => $subdomain]);
		}

}  

// Get all the devices associated with this Client (restaurant)





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
    $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
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
		 $totalPrice = number_format($totalPrice, 2);
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
		    $totalPrice = number_format($totalPrice, 2);
           return response()->json([
               'message' => 'Quantité a été modifié avec succès',
               
                
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
       $subdomain = $parsedUrl['host'];
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
