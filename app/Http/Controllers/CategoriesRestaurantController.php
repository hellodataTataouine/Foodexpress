<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoriesRestaurant;
use App\Models\Produits;
use App\Models\ProduitsRestaurants;
use App\Models\ProduitsFamilleOption;
use App\Models\ProduitsFOptionsrestaurant;
use App\Models\FamilleOption;
use App\Models\familleOptionsRestaurant;
use App\Models\Option;
use App\Models\OptionsRestaurant;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use App\Models\ClientRestaurat;
use App\Models\Command;

class CategoriesRestaurantController extends Controller
{
    
    public function index()
    {

       
        
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;

        $categories = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->get();
			
				// stats
			
		$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();
			
			
       return view('restaurant.categories.index', compact('categories', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }}
    
    public function destroy(CategoriesRestaurant $category)
    {

        $produits = ProduitsRestaurants::where('categorie_rest_id', $category->id)->get();
        foreach( $produits as $produit ){
          $produit->delete(); 
        }
        $category->delete();
        return redirect()->route('restaurant.categories.index')->with('success', 'Categorie supprimée avec succès.');
    }

    
    public function produitsCategorie(CategoriesRestaurant $category)
    {
        $var=1;
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
				$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();
        $products = ProduitsRestaurants::where('categorie_rest_id', $category->id)->where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.produits.index', compact('var','products', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
    }}
    public function create()
    {
        $categories =Categories::all();
            return view('restaurant.categories.create', compact('categories'));
    }

   
    

    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
    
        if (!$user || !$user->restaurant) {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    
        $restaurant = $user->restaurant;
        
        $existingCategory = CategoriesRestaurant::where('name', $request->categoryName)
            ->where('restaurant_id', $restaurant->id)
            ->first();
    
        if ($existingCategory) {
            return response()->json(['error' => 'This category already exists.'], Response::HTTP_BAD_REQUEST);
        }
        $categoriescount = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->count();
        $category = new CategoriesRestaurant();
        $category->name = $request->categoryName;
        $category->RowN = $categoriescount + 1;
        $category->restaurant_id = $restaurant->id;
        $category->save();
    
        $categoryId = $category->id;
    
        if ($request->has('products')) {
            foreach ($request->input('products') as $productData) {
                $produit = new ProduitsRestaurants();
                $produit->nom_produit = $productData['nom_produit'];
                $produit->description = $productData['description'];
                $produit->url_image = $productData['url_image'];
                $produit->prix = $productData['prix'];
                $produit->categorie_rest_id = $categoryId;
                $produit->status = '1';
                $produit->restaurant_id = $restaurant->id;
                $produit->save();
    
                $id_source_produit = $productData['id_produit'];
    
                $produitFamilleOptions = ProduitsFamilleOption::where('produit_id', $id_source_produit)
                    ->get();
    
                foreach ($produitFamilleOptions as $produitFamilleOption) {
                    $familleOption = FamilleOption::find($produitFamilleOption->famille_option_id);
    
                    $familleOptionRestaurant = familleOptionsRestaurant::where('nom_famille_option', $familleOption->nom_famille_option)
                        ->where('type', $familleOption->type)
                        ->where('restaurant_id', $restaurant->id)
                        ->first();
    
                    if (!$familleOptionRestaurant) {
                        $familleOptionRestaurant = new familleOptionsRestaurant();
                        $familleOptionRestaurant->nom_famille_option = $familleOption->nom_famille_option;
                        $familleOptionRestaurant->type = $familleOption->type;
                        $familleOptionRestaurant->restaurant_id = $restaurant->id;
                        $familleOptionRestaurant->save();
                    }
    
                    $options = Option::where('famille_option_id', $familleOption->id)->get();
    
                    if (!$options->isEmpty()) {
                        foreach ($options as $option) {
                            $optionRestaurant = OptionsRestaurant::where('nom_option', $option->nom_option)
                                ->where('famille_option_id_rest', $familleOptionRestaurant->id)
                                ->first();
    
                            if (!$optionRestaurant) {
                                $optionRestaurant = new OptionsRestaurant();
                                $optionRestaurant->nom_option = $option->nom_option;
                                $optionRestaurant->prix = $option->prix;
                                $optionRestaurant->restaurant_id = $restaurant->id;
                                $optionRestaurant->famille_option_id_rest = $familleOptionRestaurant->id;
                                $optionRestaurant->save();
                            }
                        }
                    }
    
                    $ProduitsFOptionsrestaurant = new ProduitsFOptionsrestaurant();
                    $ProduitsFOptionsrestaurant->id_produit_rest = $produit->id;
                    $ProduitsFOptionsrestaurant->id_familleoptions_rest = $familleOptionRestaurant->id;
                    $ProduitsFOptionsrestaurant->save();
                }
            }
        }
    
        return redirect()->route('restaurant.categories.index')->with('success', 'Categorie ajoutée avec succès');
    }
    

    

    public function fetchProducts(Request $request)
    {
        $categoryId =request()->query('categoryId');
        $category = Categories::find($categoryId);
        $products = $category->produits;

        return response()->json(['products' => $products]);
    }


    public function edit($id)
    {
         $category =   CategoriesRestaurant::findOrFail($id);


            return view('restaurant.categories.edit', compact('category'));


    }

     public function update(Request $request, $id)
    {
        $category = CategoriesRestaurant::find($id);

        if ($category) {
			 $request->validate([
        
        'image' => 'image|mimes:jpeg,png,gif|max:2048|dimensions:min_width=200,min_height=200',
    ], [
        'image.image' => 'The uploaded file is not an image.',
        'image.mimes' => 'Only JPEG, PNG, and GIF formats are allowed.',
        'image.max' => 'The image size should not exceed 2MB.',
        'image.dimensions' => 'The minimum image dimensions are 200x200 pixels.',
    ]);
			
			
			
			 if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'uploads/';
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $imageUrl = $imagePath . '/' . $imageName;
    
            // Delete the previous image file if it exists
            if ($category->url_image) {
                Storage::disk('public')->delete($category->url_image);
            }
    
            $category->url_image = $imageUrl;
        }
            $category->name = $request->input('name');
            $category->save();

                return redirect()->route('restaurant.categories.index')->with('success', 'Categorie Modifier Avec succès');

        }

    }
   public function createSpecifique(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->restaurant) {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return response()->json(['success' => false, 'message' => 'User or restaurant not found'], 400);
        }
    
        $restaurant = $user->restaurant;
        $categoriesCount = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->count();
     $request->validate([
        
        'image' => 'image|mimes:jpeg,png,gif|max:2048|dimensions:min_width=200,min_height=200',
    ], [
        'image.image' => 'Le fichier téléchargé n est pas une image.',
        'image.mimes' => 'Seuls les formats JPEG, PNG et GIF sont autorisés.',
        'image.max' => 'La taille de l image ne doit pas dépasser 2 Mo.',
        'image.dimensions' => 'Les dimensions minimales de l image doivent être de 200x200 pixels.',
    ]);
        // Check if an image file was uploaded
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imagePath = 'uploads/' . $imageName;
            $imageFile->move(public_path('uploads'), $imageName);
        } else {
            // No image provided or selected
            $imagePath = null;
        }
    
        $category = new CategoriesRestaurant();
        $category->name = $request->categoryName;
        $category->RowN = $categoriesCount + 1;
        $category->restaurant_id = $restaurant->id;
        $category->url_image = $imagePath; // Set the image path
    
        $category->save();
    
        return response()->json(['success' => true, 'message' => 'Catégorie ajoutée']);
    }

    public function updateCategoryRowN(Request $request) {
        $categoryId = $request->input('categoryId');
        $rowN = $request->input('rowN');
    
        // Find the category
        $category = CategoriesRestaurant::find($categoryId);
    
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found']);
        }
    
        // Update the RowN property and save
        $category->RowN = $rowN;
        $category->save();
    
        return response()->json(['success' => true, 'message' => 'RowN updated']);
    }
    
    

}
