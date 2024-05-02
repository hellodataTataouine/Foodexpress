<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Produits;


class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $products = produits::all();
    
       
            return view('admin.categories.index', compact('categories', 'products'));
       

    }
  
    public function destroy(Categories $category)
    {
        $produits = produits::where('categorie_id', $category->id)->get();
        foreach( $produits as $produit ){
          $produit->delete(); 
        }
        
        $category->delete();
            return redirect()->route('admin.categories.index')->with('success', 'Categorie supprimeé avec succès.');
       
    }

    public function create()
    {
            return view('admin.categories.create');
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $category = new Categories();
        $category->name = $request->name;
        $category->date_creation = now();
       
        $category->save();

             return redirect()->route('admin.categories.create')->with('success', 'Catégorie ajoutée avec succès.');
      
        
    }

    public function edit($id)
    {
        $category = Categories::find($id);

             return view('admin.categories.edit', compact('category'));
       
       
    }

    public function getProducts(Request $request)
    {
        $categoryId = $request->categoryId;
        $category = Categories::findOrFail($categoryId);
        $products = $category->produits()->get();
    
        return view('partials.product_checkboxes', compact('products'))->render();
    }

    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        
        if ($category) {
            $category->name = $request->input('name');
            $category->save();
                return redirect()->route('admin.categories.index')->with('success', 'Categorie Modifiée Avec succée');
           
        } else {
                return redirect()->route('admin.categories.index')->with('error', 'Unauthorized access.');
           
        }
    
    }
}
