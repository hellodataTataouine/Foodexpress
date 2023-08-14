<?php

namespace App\Http\Controllers;

use App\Models\CategoriesRestaurant;
use App\Models\familleOptionsRestaurant;
use App\Models\ProduitsFamilleOption;
use App\Models\ProduitsFOptionsrestaurant;
use App\Models\ProduitsRestaurants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Produits;
use App\Models\Categories;
use App\Models\User;
use App\Models\Client;
use App\Models\FamilleOption;
use App\Models\UserProduct;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;




class ProduitsController extends Controller
{
   


    public function index()
{
    $produits = Produits::with('categories')->paginate(10);
    $owners = User::all(); // Retrieve all owners from the database

    return view('admin.produits.index', compact('produits', 'owners'));
}
public function indexResto()
{
   
   
  $userId = Auth::id();
  $user = User::find($userId);
  if (!$user || !$user->restaurant) {
      return redirect()->back()->with('error', 'No restaurant found for the user.');
  }
  
  $restaurant = $user->restaurant;

  $produits = ProduitsRestaurants::with('categories')->paginate(10);
 





    foreach ($produits as $produit) {
        // Check if the product is selected for the user
        $produit->is_selected = $user->userProducts()->where('product_id', $produit->id)->exists();
    }

    return view('restaurant.produits.index', compact('produits'));
}


public function indexRestoAdmin()
{
    $userId = 1;
    $user = Auth::user();

    $produits = Produits::with('categories')
        ->where('owner_id', $userId)
        ->paginate(9);

    foreach ($produits as $produit) {
        // Check if the product is selected for the user
        $produit->is_selected = $user->userProducts()->where('product_id', $produit->id)->exists();
    }
    $categories = Categories::where('owner_id', $userId)->get();
    $familleOptions = FamilleOption::where('owner_id', $userId)->get(); // Retrieve famille options



    return view('restaurant.produits.all', compact('produits','categories','familleOptions'));

}
public function indexRestoAllProduits()
{
    $user = Auth::user();
    $produits = Produits::with('categories')->paginate(9);

    foreach ($produits as $produit) {
        // Check if the product is selected for the user
        $produit->is_selected = $user->userProducts()->where('product_id', $produit->id)->exists();
    }

    return view('restaurant.produits.index', compact('produits'));
}

public function toggleSelection(Request $request)
{
    $productId = $request->input('productId');
    $userId = Auth::id();

    $userProduct = UserProduct::where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($userProduct) {
        // Product exists in user_product table, so remove it
        $userProduct->delete();
        return response()->json(['message' => 'Product deselected.']);
    } else {
        // Product doesn't exist in user_product table, so add it
        $userProduct = new UserProduct();
        $userProduct->user_id = $userId;
        $userProduct->product_id = $productId;
        $userProduct->save();
        return response()->json(['message' => 'Product selected.']);
    }
}


public function removeProductResto(Request $request)
{
    $user = Auth::user();
    $productId = $request->input('product_id');

    // Find and delete the user's product
    UserProduct::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->delete();

    return response()->json([
        'message' => 'Product removed successfully',
        'status' => 'not-selected'
    ]);
}
public function restaurantIndex()
{
    // Get the ID of the logged-in user
    $userId = Auth::id();

    // Retrieve products with their related categories where the owner ID matches the logged-in user's ID
    $produits = Produits::with(['produits' => function ($query) use ($userId) {
        $query->where('owner_id', $userId);
    }])
    ->paginate(9);

    // Check if the user is not an admin (is_admin == 0) or the related categories is empty
    if (!Auth::user() || Auth::user()->is_admin !== 0 || $produits->isEmpty()) {
        Auth::logout();
        return abort(403, 'Unauthorized');
    }

    $loggedInUserId = auth()->id(); // Retrieve the ID of the logged-in user
    $user = User::find($loggedInUserId); // Retrieve the user with the matching ID
    
    return view('restarant.produits.index', compact('produits', 'owners'));
}


    public function getOptionsByFamilleOptions(Request $request)
    {
        // Retrieve the selected famille options from the request
        $familleOptions = $request->input('familleOptions');

        // Query the options based on the selected famille options
        $options = Option::whereIn('famille_option_id', $familleOptions)->get();

        // Prepare the response data
        $responseData = $options->map(function ($option) {
            return [
                'id' => $option->id,
                'nom_option' => $option->nom_option,
            ];
        });

        // Return the JSON response
        return response()->json($responseData);
    }

  
    
    public function create()
    {
        $categories = Categories::all();
        $familleOptions = FamilleOption::all();
       // $owner = User::find(Auth::id()); // Retrieve the logged-in user
        
        
            return view('admin.produits.create', compact('categories', 'familleOptions'));
        
    }
    public function createResto()
{
    $userId = Auth::id();
    $user = User::find($userId);
    $restaurant = $user->restaurant;
    $categories = [];
    $familleOptions = [];
    if ($restaurant) {
 $categories = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->get();
    }
 $familleOptions = FamilleOption::all();
   // $owner = User::find(Auth::id()); // Retrieve the logged-in user

        return view('restaurant.produits.create', compact('categories', 'familleOptions'));
   
}


public function addProductResto(Request $request)
{

    /*$userId = Auth::id();
    $user = User::find($userId);
    if (!$user || !$user->restaurant) {
        return redirect()->back()->with('error', 'No restaurant found for the user.');
    }
    
    $restaurant = $user->restaurant;

*/
    $validatedData = $request->validate([
        'nom_produit' => 'required',
        'description' => 'required',
        'prix' => 'required',
        'categorie_rest_id' => 'required',
    ]);

    // Retrieve the uploaded image file
    $imageFile = $request->file('url_image');

    // Check if an image file was uploaded
    if ($imageFile) {
        // Store the uploaded image and retrieve its URL
        $imagePath = $imageFile->store('public/images');
        $imageUrl = asset('storage/' . $imagePath);
    } elseif ($request->has('url_image')) {
        // Use the URL of the existing image
        $imageUrl = $request->input('url_image');
    } else {
        // No image provided or selected
        $imageUrl = null;
    }
   
    // Create a new product record
    $product = new ProduitsRestaurants;
    $product->nom_produit = $request->input('nom_produit');
    $product->description = $request->input('description');
    $product->prix = $request->input('prix');
    $product->categorie_rest_id = $request->input('categorie_rest_id');
    $product->status = 1; // Or any other default value
  //  $product->restaurant_id =  $restaurant->id; // Or any other default value
    
     // Handle image upload
     if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = 'uploads/' . $imageName;
        $image->move(public_path('uploads'), $imageName);
        $product->url_image = $imagePath;
    }

    $product->save();


// create famille options of produit
$familleOptions = $request->input('famille_options');
foreach ($familleOptions as $familleOptionId) {
    $familleOption = new familleOption;
    $familleOption = familleOption::find($familleOptionId);
    $familleOptionsrestaurant =  new familleOptionsRestaurant;
   
        $familleOptionsrestaurant->nom_famille_option = $familleOption->nom_famille_option;
        $familleOptionsrestaurant->type = $familleOption->type;
        $familleOptionsrestaurant->save();


    ProduitsFOptionsrestaurant::create([
        'id_produit_rest' => $product->id,
        'id_familleoptions_rest' =>  $familleOptionsrestaurant->id,
    ]);
   
}

// Attach famille options to the produit

foreach ($familleOptions as $familleOptionId) {
   
    ProduitsFOptionsrestaurant::create([
        'id_produit_rest' => $product->id,
        'id_familleoptions_rest' => $familleOptionId,
    ]);
}
    // Redirect to the product list page with a success message
    return redirect()->route('restaurant.produits.index')->with('success', 'Product added successfully');
}


    
    
    


    public function store(Request $request)
    {
        $request->validate([
            'nom_produit' => 'required',
            'description' => 'required',
            'image' => 'image',
            'prix' => 'required',
            'categorie_id' => 'required',
        ]);

        $produit = new Produits;
        $produit->nom_produit = $request->nom_produit;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->categorie_id = $request->categorie_id;
        $produit->status = $request->status ?? 0;
        $produit->owner_id = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/' . $imageName;
            $image->move(public_path('uploads'), $imageName);
            $produit->url_image = $imagePath;
        }

        $produit->save();

       
 // Attach famille options to the produit
 $familleOptions = $request->input('famille_options');
 foreach ($familleOptions as $familleOptionId) {
     ProduitsFamilleOption::create([
         'produit_id' => $produit->id,
         'famille_option_id' => $familleOptionId,
     ]);
 }


        if (Auth::user()->is_admin == 1) {

            
            return redirect()->route('admin.produits.index')->with('success', 'Produit created successfully.');
        } else {
            return redirect()->route('restaurant.produits.index')->with('success', 'Produit created successfully.');
        }
    }





    public function edit($id)
    {
        $produit = Produits::findOrFail($id);
        $categories = Categories::all();
        $familleOptions = FamilleOption::all();
       
        $selectedFamilleOptions = $produit->familleOptions->pluck('id')->toArray();
        $owners = User::all();
    
        if (Auth::user()->is_admin == 1) {
            return view('admin.produits.edit', compact('produit', 'categories', 'familleOptions', 'selectedFamilleOptions'));
        } else {
            return view('restaurant.produits.edit', compact('produit', 'categories', 'familleOptions', 'selectedFamilleOptions'));
        }
    }
    


    public function update(Request $request, $id)
{
    $request->validate([
        'nom_produit' => 'required',
        'description' => 'required',
        'image' => 'image',
        'prix' => 'required',
        'categorie_id' => 'required',
       
    ]);

    $produit = Produits::findOrFail($id);

    // Handle image update
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = 'uploads/';
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move($imagePath, $imageName);
        $imageUrl = $imagePath . '/' . $imageName;

        // Delete the previous image file if it exists
        if ($produit->url_image) {
            Storage::delete($produit->url_image);
        }

        $produit->url_image = $imageUrl;
    }
    $produit->nom_produit = $request->nom_produit;
    $produit->description = $request->description;
    $produit->prix = $request->prix;
    $produit->categorie_id = $request->categorie_id;
   
   
    $produit->save();


    
    $familleOptions = $request->input('famille_options');
    if ($familleOptions) {
        $produit->familleOptions()->sync($familleOptions);
    }

   
    if (Auth::user()->is_admin == 1) {

            
        return redirect()->route('admin.produits.index')->with('success', 'Produit updated successfully.');
    } else {
        return redirect()->route('restaurant.produits.index')->with('success', 'Produit updated successfully.');
    }
   
}


public function delete($id)
{
    $produit = Produits::findOrFail($id);
    $owners = User::all(); // Retrieve all owners from the database
    if (Auth::user()->is_admin == 1) {
        return view('admin.produits.delete', compact('produit', 'owners'));
    } else {
        return view('restaurant.produits.delete', compact('produit', 'owners'));
    }
}


public function destroy($id)
{
    $produit = Produits::findOrFail($id);

    // Delete the associated image file if it exists
    if ($produit->url_image) {
        Storage::delete($produit->url_image);
    }

    $produit->delete();
    if (Auth::user()->is_admin == 1) {
        return redirect()->route('admin.produits.index')->with('success', 'Produit deleted successfully.');
    } else {
        return redirect()->route('restaurant.produits.index')->with('success', 'Produit deleted successfully.');
    }
}

public function show($id)
{
    $produit = Produits::findOrFail($id);
    $owners = User::all(); // Retrieve all owners from the database
    if (Auth::user()->is_admin == 1) {
        return view('admin.produits.show', compact('produit', 'owners'));
    } else {
        return view('restaurant.produits.show', compact('produit', 'owners'));
    }
}

    public function updateStatus(Request $request)
    {
        $productId = $request->input('productId');
        $newStatus = $request->input('newStatus');

        $product = Produits::findOrFail($productId);
        $product->status = $newStatus;
        $product->save();

        return response()->json(['success' => true]);
    }


    public function removeOption($produitId, $optionId)
    {
        try {
            DB::table('produits_famille_option')
                ->where('produit_id', $produitId)
                ->where('famille_option_id', $optionId)
                ->delete();
                if (Auth::user()->is_admin == 1) {
                    return redirect()->route('admin.produits.edit', $produitId)->with('success', 'Option removed successfully');
                } else {
                    return redirect()->route('restaurant.produits.edit', $produitId)->with('success', 'Option removed successfully');
                }
        } catch (\Exception $e) {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.produits.edit', $produitId)->with('error', 'An error occurred');
            } else {
                return redirect()->route('restaurant.produits.edit', $produitId)->with('error', 'An error occurred');
            }
        }
    }
    


    


    
}
