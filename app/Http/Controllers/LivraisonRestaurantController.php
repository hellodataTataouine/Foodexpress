<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LivraisonRestaurant;
use App\Models\LivraisonMethod;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;

class LivraisonRestaurantController extends Controller
{

    public function index()
{
    $users = User::with('livraisonMethods')
                 ->where('is_admin', 0)
                 ->paginate(10);

    return view('admin.livraison.indexResto', ['users' => $users]);
}

public function create()
{
    $users = Client::all();
    $livraisonMethods = LivraisonMethod::all();

    return view('admin.livraison.createResto', compact('users', 'livraisonMethods'));
}
public function showDetails($restaurant)
{
    $livraisons = LivraisonRestaurant::where('restaurant_id', $restaurant)->paginate(10);
    return view('admin.livraison.details', compact('livraisons'));
}


public function store(Request $request)
{
    $request->validate([
        'restaurant_id' => 'required|exists:users,id',
        'livraison_id' => 'required|exists:livraisons,id',
    ]);

    $livraisonRestaurant = new LivraisonRestaurant();
    $livraisonRestaurant->restaurant_id = $request->input('restaurant_id');
    $livraisonRestaurant->livraison_id = $request->input('livraison_id');
    $livraisonRestaurant->save();

    return redirect()->route('admin.restaurant.livraison.index')->with('success', 'Livraison Methode added successfully.');
}


    public function edit($id)
    {
        $livraisonRestaurant = LivraisonRestaurant::findOrFail($id);
        return view('admin.livraison.editResto', compact('livraisonRestaurant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:users,id',
            'livraison_id' => 'required|exists:livraison_methods,id',
        ]);

        $livraisonRestaurant = LivraisonRestaurant::findOrFail($id);
        $livraisonRestaurant->restaurant_id = $request->input('restaurant_id');
        $livraisonRestaurant->livraison_id = $request->input('livraison_id');
        $livraisonRestaurant->save();

        return redirect()->route('admin.livraison.indexResto')->with('success', 'Livraison Methode Modifier Avec succeé');
    }

    public function destroy($id)
    {
        $livraisonRestaurant = LivraisonRestaurant::findOrFail($id);
        $livraisonRestaurant->delete();
        return redirect()->route('admin.livraison.indexResto')->with('danger', 'Livraison Methode Deleted Avec succeé');
    }
}
