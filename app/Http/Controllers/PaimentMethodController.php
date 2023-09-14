<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\PaimentMethod;
use App\Models\PaimentRestaurant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class PaimentMethodController extends Controller
{
    public function index()
    {
        $paimentMethods = PaimentMethod::paginate(10);
        return view('admin.paiment.index', compact('paimentMethods'));
    }

    public function create()
    {
        return view('admin.paiment.create');
    }
    public function createresto($id)
    {
        $restauants = Client::all();
        $paimentMethod = PaimentMethod::findOrFail($id);
        return view('admin.paiment.createresto' , compact('paimentMethod' , 'restauants'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'type_methode' => 'required|unique:paiement|max:255',
        ]);

        PaimentMethod::create([
            'type_methode' => $request->type_methode,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.paiment.create')->with('success', ' Methode de paiement ajoutée avec succès.');
    }
    public function storeresto(Request $request)
    {
        $existingPaiement = PaimentRestaurant::where('methode', $request->type_methode)
        ->Where('restaurant_id', $request->restaurant_id)
     
        ->first();

      // Return a response indicating the uniqueness status
      if ($existingPaiement) {
        Session::flash('error', 'Cette méthode exist déja à ce restaurant');
    } else {
        PaimentRestaurant::create([
            'methode' => $request->type_methode,
            'restaurant_id' => $request->restaurant_id, 
        ]);
        return redirect()->route('admin.paiment.create')->with('success', ' Methode de paiement ajoutée avec succès.');
    }

        

      
    }

    public function edit($id)
    {
        $paimentMethod = PaimentMethod::findOrFail($id);
        return view('admin.paiment.edit', compact('paimentMethod'));
    }

    public function update(Request $request, $id)
    {
        $category = PaimentMethod::find($id);
        $category->type_methode = $request->input('type_methode');
        $category->save();
        return redirect()->route('admin.paiment.index')->with('success', 'Paiment Methode Modifier Avec succeé');
    }

    public function destroy($id)
    {
        $paimentMethod = PaimentMethod::findOrFail($id);
        $paimentMethod->delete();
        return redirect()->route('admin.paiment.index')->with('success', 'méthode de paiement supprimée avec succès.');
    }
}
