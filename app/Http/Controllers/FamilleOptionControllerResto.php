<?php

namespace App\Http\Controllers;

use App\Models\FamilleOption as FamilleOtion;
use App\Models\FamilleOption;

use App\Models\ProduitsFamilleOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;
class FamilleOptionControllerResto extends Controller
{
    public function index()
    {
        $familleOptions = FamilleOption::paginate(10);
        return view('restaurant.famille-options.index', compact('familleOptions'));
    }


    public function create()
    {
        return view('restaurant.famille-options.create');
    }
   
    
    public function store(Request $request)
    {
        $request->validate([
            'nom_famille_option' => 'required',
            'type' => 'required',
        ]);

        $familleOption = new FamilleOption();
        $familleOption->nom_famille_option = $request->input('nom_famille_option');
        $familleOption->type = $request->input('type');
        $familleOption->owner_id = Auth::id();
        $familleOption->save();

        return redirect()->route('restaurant.famille-options.index')->with('success', 'Famille option created successfully!');
    }
    public function edit($id)
    {
        // Find the famille option by ID
        $familleOption = FamilleOption::find($id);
        
        // Check if the famille option exists
        if (!$familleOption) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        
        // Return the view for editing the famille option
        return view('restaurant.famille-options.edit', compact('familleOption'));
    }
    
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'nom_famille_option' => 'required',
            'type' => 'required',
        ]);
        
        // Find the famille option by ID
        $familleOption = FamilleOption::find($id);
        
        // Check if the famille option exists
        if (!$familleOption) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        
        // Update the famille option with the validated data
        $familleOption->nom_famille_option = $validatedData['nom_famille_option'];
        $familleOption->type = $validatedData['type'];
        $familleOption->save();
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Famille Option updated successfully.');
    }
    
    public function destroy($id)
    {
        // Find the famille option by ID
        $familleOption = FamilleOption::find($id);
        
        // Check if the famille option exists
        if (!$familleOption) {
            return redirect()->back()->with('error', 'Famille Option not found.');
        }
        
        $options = Option::where('famille_option_id', $id)->get();
        foreach( $options as $option ){
          $option->delete(); 
        }

        // Delete the famille option
        $familleOption->delete();
        $familleOptionRestaurant = ProduitsFamilleOption::where('famille_option_id', $id)->get();
                   
        
        foreach ($familleOptionRestaurant as $familleOptionproduit) {
            $familleOptionproduit->delete();
            }
        // Redirect back with success message
        return redirect()->back()->with('success', 'Famille Option deleted successfully.');
    }
}
