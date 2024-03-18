<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\FamilleOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{

    public function index()
    {
        $options = Option::paginate(10);
        return view('admin.options.index', compact('options'));
    }

    public function create(Request $request)
    {
        $familleOptions = FamilleOption::all();
        $selectedFamilleOption = $request->input('famille_option_id');
        return view('admin.options.create', compact('familleOptions', 'selectedFamilleOption'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'famille_option_id' => 'required',
            'nom_option' => 'required',
            'prix' => 'nullable|numeric',
        ]);

        $option = new Option();
        $option->famille_option_id = $request->input('famille_option_id');
        $option->nom_option = $request->input('nom_option');
        $option->prix = $request->input('prix');
      
        $option->save();

        return redirect()->route('admin.options.index')->with('success', 'Option ajoutée avec succès!');
    }
    
    public function remove(Option $option)
    {
        // Perform the removal logic here
        $option->delete();

        return redirect()->back()->with('success', 'Option supprimée avec succès!');
    }



    public function edit(Option $option)
    {
        $familleOptions = FamilleOption::all();
        return view('admin.options.edit', compact('option', 'familleOptions'));
    }
    
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'famille_option_id' => 'required',
            'nom_option' => 'required',
            'prix' => 'nullable|numeric',
        ]);
    
        $option->famille_option_id = $request->input('famille_option_id');
        $option->nom_option = $request->input('nom_option');
        $option->prix = $request->input('prix');
        $option->save();
    
        return redirect()->route('admin.options.index')->with('success', 'Option modifiée avec succès!');
    }
    


}
