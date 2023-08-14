<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaimentRestaurant;
use App\Models\PaimentMethod;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;

class PaimentRestaurantController extends Controller
{

    public function index()
{
    $users = User::with('paimentMethods')
                 ->where('is_admin', 0)
                 ->paginate(10);

    return view('admin.paiment.indexResto', ['users' => $users]);
}


    

public function create()
{
    $users = Client::all();
    $paimentMethods = PaimentMethod::all();

    return view('admin.paiment.createResto', compact('users', 'paimentMethods'));
}

public function store(Request $request)
{
    $request->validate([
        'restaurant_id' => 'required|exists:users,id',
        'paiment_id' => 'required|exists:paiement,id',
    ]);

    $paimentRestaurant = new PaimentRestaurant();
    $paimentRestaurant->restaurant_id = $request->input('restaurant_id');
    $paimentRestaurant->paiment_id = $request->input('paiment_id');
    $paimentRestaurant->save();

    return redirect()->route('admin.restaurant.paiment.index')->with('success', 'Paiment Methode added successfully.');
}


    public function edit($id)
    {
        $paimentRestaurant = PaimentRestaurant::findOrFail($id);
        return view('admin.paiment.editResto', compact('paimentRestaurant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:users,id',
            'paiment_id' => 'required|exists:paiment_methods,id',
        ]);

        $paimentRestaurant = PaimentRestaurant::findOrFail($id);
        $paimentRestaurant->restaurant_id = $request->input('restaurant_id');
        $paimentRestaurant->paiment_id = $request->input('paiment_id');
        $paimentRestaurant->save();

        return redirect()->route('admin.paiment.indexResto')->with('success', 'Paiment Methode Modifier Avec succeé');
    }

    public function destroy($id)
    {
        $paimentRestaurant = PaimentRestaurant::findOrFail($id);
        $paimentRestaurant->delete();
        return redirect()->route('admin.paiment.indexResto')->with('danger', 'Paiment Methode Deleted Avec succeé');
    }
}
