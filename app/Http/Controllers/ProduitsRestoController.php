<?php

namespace App\Http\Controllers;

use App\Models\ProduitsFOptionsrestaurant;
use Illuminate\Http\Request;
use App\Models\ProduitsRestaurants;
use App\Models\User;
use App\Models\CategoriesRestaurant;
use App\Models\familleOptionsRestaurant;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Client;
use App\Models\ClientRestaurat;
use App\Models\Command;

class ProduitsRestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $var=0;
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
      $products = ProduitsRestaurants::where('restaurant_id', $restaurant->id)
                ->with('categories')
                ->get();
      /*   foreach ($produits as $produit) {
              // Check if the product is selected for the user
              $produit->is_selected = $user->userProducts()->where('product_id', $produit->id)->exists();
          }*/
			// stats
			
		$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();

      
          return view('restaurant.produits.index', compact('var','products', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
      
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }}
	
public function getAllProducts() {
    $userId = Auth::id();
    $user = User::find($userId);

    if ($user) {
        $restaurant = $user->restaurant;
        $products = ProduitsRestaurants::where('restaurant_id', $restaurant->id)->get();
        return response()->json($products);
    }
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
     $categories = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->get();
     $familleOptions = FamilleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();
       
            return view('restaurant.produits.create', compact('categories', 'familleOptions'));
        }else {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
}



  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
      
          $validatedData = $request->validate([
              'nom_produit' => 'required',
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
          $product = new ProduitsRestaurants;;
          $product->nom_produit = $request->input('nom_produit');
          $product->description = $request->input('description');
          $product->prix = $request->input('prix');
          $product->categorie_rest_id = $request->input('categorie_rest_id');
          $product->restaurant_id = $restaurant->id;
          $product->status = 1; // Or any other default value
          
           // Handle image upload
           if ($request->hasFile('image')) {
              $image = $request->file('image');
              $imageName = time() . '.' . $image->getClientOriginalExtension();
              $imagePath = 'uploads/' . $imageName;
              $image->move(public_path('uploads/'), $imageName);
              $product->url_image = $imagePath;
          }
      
          $product->save();
      
      
      // create famille options of produit
      $familleOptions = $request->input('famille_options');
       if($familleOptions){
      
      // Attach famille options to the produit
      
      foreach ($familleOptions as $familleOptionId) {
         
          ProduitsFOptionsrestaurant::create([
              'id_produit_rest' => $product->id,
              'id_familleoptions_rest' => $familleOptionId,
          ]);
      }}
          // Redirect to the product list page with a success message
          return redirect()->route('restaurant.produits.index')->with('success', 'Produit ajouté avec succès');
      
        }else {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        } }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
        $produit = ProduitsRestaurants::findOrFail($id);
        $categories = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->get();
     $familleOptions = familleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();
    
        $selectedFamilleOptions = $produit->familleOptions->pluck('id')->toArray();
        $currentOptions = ProduitsFOptionsrestaurant::select('produit_familleoptions_restaurant.id_produit_rest', 'produit_familleoptions_restaurant.id_familleoptions_rest', 'produit_familleoptions_restaurant.RowN')
        ->join('produits_restaurant', 'produit_familleoptions_restaurant.id_produit_rest', '=', 'produits_restaurant.id')
        ->where('produit_familleoptions_restaurant.id_produit_rest', $id)
        ->get();
       $temporaryOrder = $currentOptions->pluck('RowN', 'id_familleoptions_rest')->toArray();
            return view('restaurant.produits.edit', compact('produit', 'categories', 'familleOptions', 'selectedFamilleOptions', 'currentOptions', 'temporaryOrder'));
       
        }else {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        } }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
    
        $produit = ProduitsRestaurants::findOrFail($id);
    
        // Handle image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'uploads/';
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $imageUrl = $imagePath . '/' . $imageName;
    
            // Delete the previous image file if it exists
            if ($produit->url_image) {
                Storage::disk('public')->delete($produit->url_image);
            }
    
            $produit->url_image = $imageUrl;
        }
        $produit->nom_produit = $request->nom_produit;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
		 $produit->status = $request->status;
        $produit->categorie_rest_id = $request->categorie_id;
       
       
        $produit->save();
    
    
        
        $familleOptions = $request->input('famille_options');
        if ($familleOptions) {
			$temporaryOrder = json_decode($request->temporary_order, true);
			//dd($familleOptions);
            $produit->familleOptions()->sync($familleOptions);
        }
		else{
		
	 ProduitsFOptionsrestaurant::where('id_produit_rest', $produit->id)
                       
                        ->delete();
		}
    
         $options= ProduitsFOptionsrestaurant::where('id_produit_rest', $produit->id)->get();;
    //dd($childs);
    if($options != null){
      foreach($options as $option) {
        //dd($child->child_id, $temporaryOrder);
        
        $option->RowN = $temporaryOrder[$option->id_familleoptions_rest];
        $option->save();
        //dd($temporaryOrder);

      }  
	}
      
        return redirect()->route('restaurant.produits.index')->with('success', 'Produit modifié avec succès.');
              
       
    }

    public function updatestatus(Request $request)
    {
        $product_id = $request->input('product_id');
        $status = $request->input('status');

        // Assuming you have a 'products' table with a 'status' column, you can update the status like this:
        $product = ProduitsRestaurants::findOrFail($product_id);
        $product->status = $status;
        $product->save();

        // You can return a response to indicate the update was successful if needed.
        return response()->json(['success' => true]);
    }
    
    /**
     * Remove the specified resource from storage.
     */

     public function delete($id)
{
    $produit = ProduitsRestaurants::findOrFail($id);
    return view('restaurant.produits.delete', compact('produit'));
   
}
    public function destroy($id)
    {
        $produit = ProduitsRestaurants::findOrFail($id);

    // Delete the associated image file if it exists
    if ($produit->url_image) {
        Storage::delete($produit->url_image);
    }

    $produit->delete();
    
        return redirect()->route('restaurant.produits.index')->with('success', 'Produit supprimé avec succès.');
    
    }
    public function updateProductRowN(Request $request) {
        //dd($request);
        $productId = $request->input('productId');
        $rowN = $request->input('rowN');
    
        // Find the category
        $product = ProduitsRestaurants::find($productId);
    
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Category not found']);
        }
        // Update the RowN property and save
        $product->RowN = $rowN;
        $product->save();
    
        return response()->json(['success' => true, 'message' => 'RowN updated']);
    }
}
