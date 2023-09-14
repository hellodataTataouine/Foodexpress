<?php

namespace App\Http\Controllers;

use App\Models\FamilleOption;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilleOptionController extends Controller
{
    public function index()
    {
        $familleOptions = FamilleOption::paginate(10);
        return view('admin.famille-options.index', compact('familleOptions'));
    }


    public function create()
    {
        return view('admin.famille-options.create');
    }
    public function show(FamilleOption $familleOption)
    {
        $options = Option::where('famille_option_id', $familleOption->id)->paginate(10);
        return view('admin.options.list', compact('options'));
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

        return redirect()->route('admin.famille-options.index')->with('success', 'la famille doption a été ajouté avec succès!');
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
        return view('admin.famille-options.edit', compact('familleOption'));
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
        return redirect()->back()->with('success', 'Famille Option  modifiée avec succès.');
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
        return redirect()->back()->with('success', 'Famille Optiona  supprimer avec succès.');
    }
}
