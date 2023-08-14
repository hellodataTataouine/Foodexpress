<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaimentMethod;
use Illuminate\Http\Request;

class PaimentMethodController extends Controller
{
    public function index()
    {
        $paimentMethods = PaimentMethod::paginate(10);
        return view('admin.paiment.index', compact('paimentMethods'));
    }

    public function create()
    {
        return view('admin.paiment.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'type_methode' => 'required|unique:paiement|max:255',
        ]);

        PaimentMethod::create([
            'type_methode' => $request->type_methode,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.paiment.create')->with('success', 'Paiment Methode created successfully.');
    }

    public function edit($id)
    {
        $paimentMethod = PaimentMethod::findOrFail($id);
        return view('admin.paiment.edit', compact('paimentMethod'));
    }

    public function update(Request $request, $id)
    {
        $category = PaimentMethod::find($id);
        $category->type_methode = $request->input('type_methode');
        $category->save();
        return redirect()->route('admin.paiment.index')->with('success', 'Paiment Methode Modifier Avec succeé');
    }

    public function destroy($id)
    {
        $paimentMethod = PaimentMethod::findOrFail($id);
        $paimentMethod->delete();
        return redirect()->route('admin.paiment.index')->with('success', 'paiment deleted successfully.');
    }
}
