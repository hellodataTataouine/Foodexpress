<?php

namespace App\Http\Controllers;

use App\Models\ProduitsFOptionsrestaurant;
use Illuminate\Http\Request;
use App\Models\familleOptionsRestaurant;
use App\Models\User;
use App\Models\OptionsRestaurant;
use Illuminate\Support\Facades\Auth;

use App\Models\Client;
use App\Models\ClientRestaurat;
use App\Models\ProduitsRestaurants;
use App\Models\Command;

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
     
            $familleOptions = FamilleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();
				
					// stats
			
		$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();
				
				
            return view('restaurant.famille-options.index', compact('familleOptions', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
      
        
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

        return redirect()->route('restaurant.famille-options.index')->with('success', 'Famille option ajoutée  avec succès!');
    } else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }
    }
   

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $familleOptionRestaurant = familleOptionsRestaurant::find($id);
        
        // Check if the famille option exists
        if (!$familleOptionRestaurant) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        
        // Return the view for editing the famille option
        return view('restaurant.famille-options.edit', compact('familleOptionRestaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nom_famille_option' => 'required',
            'type' => 'required',
        ]);
        
        // Find the famille option by ID
        $familleOption = familleOptionsRestaurant::find($id);
        
        // Check if the famille option exists
        if (!$familleOption) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        
        // Update the famille option with the validated data
        $familleOption->nom_famille_option = $validatedData['nom_famille_option'];
        $familleOption->type = $validatedData['type'];
        $familleOption->save();
        
        // Redirect back with success message
        return redirect()->route('restaurant.famille-options.index')->with('success', 'Famille Option modifiée  avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
       
           // Find the famille option by ID
        $familleOption = familleOptionsRestaurant::find($id);
        
        // Check if the famille option exists
        if (!$familleOption) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        // Delete all options attached
        $options = OptionsRestaurant::where('famille_option_id_rest', $id)->get();
        foreach( $options as $option ){
          $option->delete(); 
        }
        // Delete the famille option
        $familleOption->delete();
        $familleOptionRestaurant = ProduitsFOptionsrestaurant::where('id_familleoptions_rest', $id)->get();
                   
        
        foreach ($familleOptionRestaurant as $familleOptionproduit) {
            $familleOptionproduit->delete();
            }
        // Redirect back with success message
        return redirect()->back()->with('success', 'Famille Option supprimée avec succès.');
      
    }
}
