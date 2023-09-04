<?php

namespace App\Http\Controllers;
use App\Models\OptionsRestaurant;
use App\Models\familleOptionsRestaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class OptionRestoController extends Controller
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
 
        $options = OptionsRestaurant::where('restaurant_id', $restaurant->id)->paginate(10);
        return view('restaurant.options.index', compact('options'));
        }else {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
 
        $familleOptions = FamilleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();;
        $selectedFamilleOption = $request->input('famille_option_id');
        return view('restaurant.options.create', compact('familleOptions', 'selectedFamilleOption'));
 
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }  }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
 
      /*  $request->validate([
           // 'famille_option_id_rest' => 'required',
            'nom_option' => 'required',
            'prix' => 'required|numeric',
        ]);*/

        $option = new OptionsRestaurant();
        $option->famille_option_id_rest = $request->input('famille_option_id');
        $option->nom_option = $request->input('nom_option');
        $option->prix = $request->input('prix');
       $option->restaurant_id = $restaurant->id;
        $option->save();

        return redirect()->route('restaurant.options.index')->with('success', 'Option added successfully!');
  
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }   }
    public function remove(OptionsRestaurant $option)
    {
        // Perform the removal logic here
        $option->delete();

        return redirect()->back()->with('success', 'Option removed successfully!');
    }
    public function edit(OptionsRestaurant $option)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
        $familleOptions = familleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.options.edit', compact('option', 'familleOptions'));
    }else {
       
        return redirect()->back();
    }  
 }
    
    public function update(Request $request, OptionsRestaurant $option)
    {
        $request->validate([
            'famille_option_id_rest' => 'required',
            'nom_option' => 'required',
            'prix' => 'required|numeric',
        ]);
    
        $option->famille_option_id_rest = $request->input('famille_option_id');
        $option->nom_option = $request->input('nom_option');
        $option->prix = $request->input('prix');
        $option->save();
    
        return redirect()->route('restaurant.options.index')->with('success', 'Option updated successfully!');
    }
    


}
