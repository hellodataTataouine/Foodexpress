<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivraisonRestaurant;
use App\Models\LivraisonMethod;

use App\Models\Client;

class LivraisonMethodController extends Controller
{
    public function index()
    {
        $livraisons = LivraisonMethod::paginate(10);
        return view('admin.livraison.index', compact('livraisons'));
    }

    public function create()
    {
        return view('admin.livraison.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'type_methode' => 'required|unique:livraisons|max:255',
        ]);

        LivraisonMethod::create([
            'type_methode' => $request->type_methode,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.livraison.create')->with('success', 'livraison Methode created successfully.');
    }

    public function edit($id)
    {
        $livraison = LivraisonMethod::findOrFail($id);
        return view('admin.livraison.edit', compact('livraison'));
    }

    public function update(Request $request, $id)
    {
        $category = LivraisonMethod::find($id);
        $category->type_methode = $request->input('type_methode');
        $category->save();
        return redirect()->route('admin.livraison.index')->with('success', 'livraison Methode Modifier Avec succeé');
    }

    public function destroy($id)
    {
        $livraison = LivraisonMethod::findOrFail($id);
        $livraison->delete();
        return redirect()->route('admin.livraison.index')->with('success', 'livraison deleted successfully.');
        // Redirect or return a response
    }
}
