<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Client;
use App\Models\ProduitsRestaurants;
use App\Models\CategoriesRestaurant;
use App\Models\LivraisonRestaurant;
use App\Models\familleOptionsRestaurant;
use App\Models\UserProduct;
use Illuminate\Pagination\Paginator;
class ProductsController  extends controller
{

    public function index($subdomain)
    {
      //  dd($subdomain);
        $sub = $subdomain . '.' . env('mainhost');
      
        $client = Client::where('url_platform', $sub)->firstOrFail();
    
        // Retrieve the categories that exist in the produits table
        $categories = CategoriesRestaurant::where('restaurant_id', $client->id)->get();
		$livraisons = LivraisonRestaurant::where('restaurant_id', $client->id)->get();
        $categoryIds = $categories->pluck('id')->toArray();
    
        // Retrieve the first product for each category
        $firstProducts = [];
        foreach ($categoryIds as $categoryId) {
            $firstProduct = ProduitsRestaurants::where('categorie_rest_id', $categoryId)->first();
            if ($firstProduct) {
                $firstProducts[$categoryId] = $firstProduct;
            }
        }
            Paginator::defaultView('client.layouts.custom-paginator');
    
        // Retrieve the products from the produits table with matching IDs
        $products = ProduitsRestaurants::whereIn('categorie_rest_id', $categoryIds)->where('status', 1)->where('restaurant_id', $client->id)->get();
     
    // Pagination
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 1000; // Number of products per page
    $currentPageProducts = $products->forPage($currentPage, $perPage);
    $paginator = new LengthAwarePaginator($currentPageProducts, $products->count(), $perPage);
    $paginator->setPath(route('client.products.index', ['subdomain' => $subdomain]));

        // Retrieve the famille options for the products
        $familleOptions = familleOptionsRestaurant::whereIn('categorie_rest_id', $categoryIds)->with('options')->get();
    
        $cart = session()->get('cart', []);
    
        return view('client.index', compact('client', 'products', 'categories', 'livraisons' , 'subdomain', 'firstProducts', 'familleOptions', 'cart', 'paginator'));
    }
    

    
}
