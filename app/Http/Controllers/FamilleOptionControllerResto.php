<?php

namespace App\Http\Controllers;

use App\Models\FamilleOptionResto as FamilleOtion;
use App\Models\OptionRestaurant as Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show(FamilleOption $familleOption)
    {
        $options = Option::where('famille_option_id', $familleOption->id)->paginate(10);
        return view('restaurant.options.list', compact('options'));
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
        
        // Delete the famille option
        $familleOption->delete();
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Famille Option deleted successfully.');
    }
}
