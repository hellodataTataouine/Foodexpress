<?php

namespace App\Http\Controllers;
use App\Models\CommandProduct;
use App\Models\CommandProductOptions;
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
       return view('client.layouts.cart_client', compact('cartItems','cartItemCount', 'subdomain'));
   }

   public function checkout(Request $request)
   {
       $sub = $request->getHost();
       $subdomainVerif = preg_replace('/:\d+$/', '', $sub).':8000'; 
       $client = Client::where('url_platform', $subdomainVerif)->firstOrFail();
       $clientId = $client->id;
       $subdomain = $client->url_platform;
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
       $deliveryMethodId = $request->input('delivery_method');
       $paymentMethodId = $request->input('payment_method');
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
       $Command->clientPostalcode =$request->input('addresse');

       $Command->clientVille =$request->input('codePostal');

       $Command->clientNum1 =$request->input('ville');
       $Command->clientNum2 =$request->input('num1');
       $Command->clientEmail =$request->input('num1');
       $Command->clientEmail =$request->input('email');



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
return view('client.checkout_success', compact('subdomain', 'client','cart'));

     
   
}


public function registerCommand(Request $request)
{
    // Retrieve user details from the confirmation form
    $name = $request->input('name');
    $address = $request->input('address');
    $contact = $request->input('contact');

    // Create a new command entry in the database
    $command = new Command();
    // Populate the command with necessary details (e.g., customer information, time, etc.)
    // Save the command to the database
    $command->name = $name;
    $command->address = $address;
    $command->contact = $contact;
    $command->save();

    // Get the cart data from the session
    $cartItems = session()->get('cart', []);

    // Loop through the cart items and add them to the command in the database
    foreach ($cartItems as $cartItem) {
        $productId = $cartItem['id'];
        $productName = $cartItem['name'];
        $productPrice = $cartItem['price'];

        // Create a new command_produits entry for the selected product and command
        $commandProduit = new CommandeProduits();
        // Populate the command_produits entry with necessary details (e.g., product quantity, etc.)
        // Save the command_produits entry to the database
        $commandProduit->product_id = $productId;
        $commandProduit->name = $productName;
        $commandProduit->price = $productPrice;
        $command->produits()->save($commandProduit);

        // Add command_produit_options entries for the selected options and command_produits
        foreach ($cartItem['options'] as $optionId => $customization) {
            $quantity = $customization['quantity'];

            $commandProduitOption = new CommandeProduitOptions();
            // Populate the command_produit_options entry with necessary details (e.g., option quantity, etc.)
            // Save the command_produit_options entry to the database
            $commandProduit->options()->attach($optionId, ['quantity' => $quantity]);
        }
    }

    // Clear the cart data from the session after registration
    session()->forget('cart');

    // Redirect to a success page or show a success message
    return redirect()->route('restaurant.success')->with('success', 'Command registered successfully!');
}

   public function insertCartDetails($cartItems, $comandId, $restaurantId,$CartDetailsId)
    {
        $total_final = 0; // Initialize the $total_final variable outside the loop
       


        foreach ($cartItems as $cartItem) {
            $commandProduct = new CartDetails;
            $commandProduct->cart_id = $comandId;
            $commandProduct->product_id = $cartItem['id'];
              $commandProduct->qte_produit =$cartItem['quantity'];
            $commandProduct->save();
    
        foreach ($cartItems as $cartItem) {
          //  $product = ProduitsRestaurants::find($cartItem['id']);
            $totalPrice = $cartItem['price'];
            $total_final += $totalPrice;
            
            // Insert into cart_option_produits_selected table
              // Check if there are options for this cart item
        if (isset($cartItem['options']) && is_array($cartItem['options'])) {
            // Loop through the options for this cart item
            foreach ($cartItem['options'] as $optionId => $optionPrice) {
                // Insert into cart_option_produits_selected table
                 // Create a new product record
          $cartOptionProductSelected = new CommandProductOptions;
          $cartOptionProductSelected->commandProduit_id  = $CartDetailsId;
         // $cartOptionProductSelected->product_id = $cartItem['id'];
          $cartOptionProductSelected->option_id = $optionId;
          $cartOptionProductSelected->qte_options = 1;
          //$cartOptionProductSelected->prix_total_option = $total_final;

          $cartOptionProductSelected->save();
               
             
                     
              
            }
        } else {
            // Insert into cart_details table without options
           
        }
        }
    
        //$updateCart = CarteUser::find($cartUserId);
        //$updateCart->prix_total = $total_final;
       // $updateCart->save();
    }






    }





    public function registerAndCheckout(Request $request)
    {
        $sub = $request->getHost();
        $subdomainVerif = preg_replace('/:\d+$/', '', $sub).':8000'; 
        $client = Client::where('url_platform', $subdomainVerif)->firstOrFail();
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
        $basicUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 3, // Set the appropriate user role here
            'restaurant_id' => $restaurantId, // Set the appropriate restaurantId here
        ]);
 
        // Log in the newly registered user
        auth()->login($basicUser);
 
        // Get the cart items from the session
        $cartItems = session('cart', []);
 
        // Insert cart details into the database
        $cartUser = CarteUser::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurantId,
            'prix_total' => 0, // Calculate the total price based on the cart items
            'methode_paiement' => $paymentMethodId, // Set the desired payment method ID
            'mode_livraison' => $deliveryMethodId, // Set the desired delivery mode ID
            'statut_paiement' => 'Pending', // Set the desired payment status
        ]);
 
        // Call the insertCartDetails method to insert cart details and calculate the total price
        $this->insertCartDetails($cartItems, $cartUser->id, $restaurantId);
 
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
   

   // Register the command in the database
 
}
