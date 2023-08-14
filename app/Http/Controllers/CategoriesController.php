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
        $categories = Categories::where('owner_id', Auth::id())->paginate(10);
        $products = produits::all();
    
        //return view('restaurant.categories.index', compact('categories', 'products'));
    
        if (Auth::user()->is_admin == 1) {
            return view('admin.categories.index', compact('categories', 'products'));
        } else {
            return view('restaurant.categories.index', compact('categories', 'products'));
        }

    }
    public function indexResto()
    {
        $categories = Categories::where('owner_id', Auth::id())
        ->orWhere('owner_id', 1)
        ->paginate(10);
        return view('restaurant.categories.all', compact('categories'));
    }
    
    public function destroy(Categories $category)
    {
        $category->delete();
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('restaurant.categories.index')->with('success', 'Category deleted successfully.');
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin == 1) {
            return view('admin.categories.create');
        } else {
            return view('restaurant.categories.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $category = new Categories();
        $category->name = $request->name;
        $category->date_creation = now();
        $category->owner_id = Auth::id();
        $category->save();

        if (Auth::user()->is_admin == 1) {
            return redirect()->route('admin.categories.create')->with('success', 'Categories created successfully.');
        } else {
            return redirect()->route('restaurant.categories.create')->with('success', 'Categories created successfully.');
        }
        
    }

    public function edit($id)
    {
        $category = Categories::where('owner_id', Auth::id())->find($id);

        if (Auth::user()->is_admin == 1) {
            return view('admin.categories.edit', compact('category'));
        } else {
            return view('restaurant.categories.edit', compact('category'));
        }
       
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
        $category = Categories::where('owner_id', Auth::id())->find($id);
        
        if ($category) {
            $category->name = $request->input('name');
            $category->save();
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.categories.index')->with('success', 'Categories Modifier Avec succée');
            } else {
                return redirect()->route('restaurant.categories.index')->with('success', 'Categories Modifier Avec succée');
            }
        } else {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.categories.index')->with('error', 'Unauthorized access.');
            } else {
                return redirect()->route('restaurant.categories.index')->with('error', 'Unauthorized access.');
            }
        }
    
    }
}
