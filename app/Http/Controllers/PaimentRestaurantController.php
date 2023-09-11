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
        // Retrieve a list of PaimentRestaurants
        $paimentMethods = PaimentRestaurant::paginate(10);

        return view('Restaurant.paiment.index', compact('paimentMethods'));
    }

    public function create()
    {
        // You can implement a form to create a new PaimentRestaurant here
        return view('Restaurant.paiment.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'restaurant_id' => 'required',
            'paiment_id' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        // Create a new PaimentRestaurant instance
        PaimentRestaurant::create($request->all());

        // Redirect to a success page or return a response as needed
        return redirect()->route('paiment_restaurants.index')
            ->with('success', 'PaimentRestaurant created successfully');
    }

    public function show(PaimentRestaurant $paimentRestaurant)
    {
        // Show a single PaimentRestaurant
        return view('Restaurant.paiment.show', compact('paimentRestaurant'));
    }

    public function edit(PaimentRestaurant $paimentMethod)
    {
        // You can implement a form to edit the PaimentRestaurant here
        return view('Restaurant.paiment.edit', compact('paimentMethod'));
    }

    public function update(Request $request, PaimentRestaurant $paimentRestaurant)
    {
        // Validate the incoming request data
        $request->validate([
            'restaurant_id' => 'required',
            'paiment_id' => 'required',
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        // Update the PaimentRestaurant instance with the new data
        $paimentRestaurant->update($request->all());

        // Redirect to a success page or return a response as needed
        return redirect()->route('paiment_restaurants.index')
            ->with('success', 'PaimentRestaurant updated successfully');
    }

    public function destroy(PaimentRestaurant $paimentRestaurant)
    {
        // Delete the PaimentRestaurant instance
        $paimentRestaurant->delete();

        // Redirect to a success page or return a response as needed
        return redirect()->route('Restaurant.paiment.index')
            ->with('success', 'PaimentRestaurant deleted successfully');
    }
}
