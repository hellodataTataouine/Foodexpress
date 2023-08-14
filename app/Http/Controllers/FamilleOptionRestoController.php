<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\familleOptionsRestaurant;
use App\Models\User;
use App\Models\OptionsRestaurant;
use Illuminate\Support\Facades\Auth;
class FamilleOptionRestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
            $userId = Auth::id();
            $user = User::find($userId);
            if ($user) {
            
            $restaurant = $user->restaurant;
     
            $familleOptions = FamilleOptionsRestaurant::where('restaurant_id', $restaurant->id)->paginate(10);
            return view('restaurant.famille-options.index', compact('familleOptions'));
      
        
        } else {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurant.famille-options.create');

    }


    public function getoptions(familleOptionsRestaurant $familleOption)
    {
        $options = OptionsRestaurant::where('famille_option_id_rest', $familleOption->id)->paginate(10);
        return view('restaurant.options.index', compact('options'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
     
 
        $request->validate([
            'nom_famille_option' => 'required',
            'type' => 'required',
        ]);

        $familleOption = new familleOptionsRestaurant();
        $familleOption->nom_famille_option = $request->input('nom_famille_option');
        $familleOption->type = $request->input('type');
       
        $familleOption->restaurant_id =  $restaurant->id ;
        $familleOption->save();

        return redirect()->route('restaurant.famille-options.index')->with('success', 'Famille option created successfully!');
    } else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }
    }
    public function editResto($id)
    {
        // Find the famille option by ID
        $familleOptionRestaurant = familleOptionsRestaurant::find($id);
        
        // Check if the famille option exists
        if (!$familleOptionRestaurant) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        
        // Return the view for editing the famille option
        return view('restaurant.famille-options.edit', compact('familleOption'));

    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
