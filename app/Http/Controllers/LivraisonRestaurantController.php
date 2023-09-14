<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LivraisonRestaurant;
use App\Models\LivraisonMethod;
use App\Models\User;
use App\Models\Client;
use Auth;
use Illuminate\Http\Request;

class LivraisonRestaurantController extends Controller
{

    public function index()
{
    $userId = Auth::id();
    $user = User::find($userId);
    if ($user) {
    $restaurant = $user->restaurant;
    $livraisonMethods  = LivraisonRestaurant::where('restaurant_id', $restaurant->id)
    ->paginate(10);
    return view('restaurant.livraison.index', compact('livraisonMethods'));
}else {
    // Handle the case when the user does not have a restaurant
    // For example, you can redirect to a page or show an error message
    return redirect()->back();
}
  
}

public function create()
{
    $users = Client::all();
    $livraisonMethods = LivraisonMethod::all();

    return view('restaurant.livraison.create', compact('users', 'livraisonMethods'));
}



public function store(Request $request)
{
   /* $request->validate([
        'restaurant_id' => 'required|exists:users,id',
        'livraison_id' => 'required|exists:livraisons,id',
    ]);*/


    $userId = Auth::id();
    $user = User::find($userId);
    if ($user) {
    $restaurant = $user->restaurant;
    
    
    
    $existingMethode= LivraisonRestaurant::where('restaurant_id',$restaurant->id)->where('livraison_id',$request->methode_livraison)->first();
    if(!$existingMethode){
       
    $livraisonRestaurant = new LivraisonRestaurant();
    $livraisonRestaurant->restaurant_id = $restaurant->id;
    $livraisonRestaurant->livraison_id = $request->input('methode_livraison');
    $livraisonRestaurant->save();

    return redirect()->route('restaurant.livraison.index')->with('success', ' Methode de livraison ajoutée avec succès.');
}
else{
    return redirect()->route('restaurant.livraison.index')->with('error', ' Methode de livraison existe déja.');
}

    }

}
    public function edit($id)
    {
        $livraisonRestaurant = LivraisonRestaurant::findOrFail($id);
        return view('restaurant.livraison.edit', compact('livraisonRestaurant'));
    }

    public function update(Request $request, $id)
    {
       /* $request->validate([
            'restaurant_id' => 'required|exists:users,id',
            'livraison_id' => 'required|exists:livraison_methods,id',
        ]);*/

        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
        $livraisonRestaurant = LivraisonRestaurant::findOrFail($id);
        $livraisonRestaurant->restaurant_id = $restaurant->id;
        $livraisonRestaurant->methode = $request->input('type_methode');
        $livraisonRestaurant->save();

        return redirect()->route('restaurant.livraison.index')->with('success', ' Méthode de Livraison Modifiée Avec succès');
    }}

    public function destroy(LivraisonRestaurant $LivraisonMethod)
    {
      //  $livraisonRestaurant = LivraisonRestaurant::findOrFail($id);
        $LivraisonMethod->delete();
        return redirect()->route('restaurant.livraison.index')->with('danger', ' Méthode de Livraison supprimée Avec succès');
    }
}
