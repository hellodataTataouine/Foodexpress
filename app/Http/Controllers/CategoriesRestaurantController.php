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

class CategoriesRestaurantController extends Controller
{
    public function index()
    {

       
        
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;

        $categories = CategoriesRestaurant::where('restaurant_id', $restaurant->id)->paginate(10);
       return view('restaurant.categories.index', compact('categories'));
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
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
        $products = ProduitsRestaurants::where('categorie_rest_id', $category->id)->where('restaurant_id', $restaurant->id)->paginate(10);
        return view('restaurant.produits.index', compact('products'));
    }}
    public function create()
    {
        $categories =Categories::paginate(10);
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
    
        $category = new CategoriesRestaurant();
        $category->name = $request->categoryName;
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
            $category->name = $request->input('name');
            $category->save();

                return redirect()->route('restaurant.categories.index')->with('success', 'Categories Modifier Avec succée');

        }

    }
    public function createSpecifique(Request $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);
    
        if (!$user || !$user->restaurant) {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    
        $restaurant = $user->restaurant;
        $category = new CategoriesRestaurant();
        $category->name = $request->categoryName;
        $category->restaurant_id = $restaurant->id;
        $category->save();
        return response()->json(['success' => true, 'message' => 'Catégorie ajoutée']);
     }
}
