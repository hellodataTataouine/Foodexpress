<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Horaire;


class HoraireController extends Controller
{
    public function index($id)
    {
        $client = Client::findOrFail($id);
        $horaires = $client->horaires; 
        return view('admin.horaires.index', compact('client', 'horaires'));
    }
    public function store(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
        ]);

        // Find the client by ID
        $client = Client::findOrFail($id);

        // Check if the period overlaps with existing horaires for the client
        $existingHoraires = Horaire::where('client_id', $id)
            ->where(function ($query) use ($validatedData) {
                $query->where(function ($query) use ($validatedData) {
                    $query->where('date_debut', '>=', $validatedData['date_debut'])
                        ->where('date_debut', '<=', $validatedData['date_fin']);
                })
                ->orWhere(function ($query) use ($validatedData) {
                    $query->where('date_fin', '>=', $validatedData['date_debut'])
                        ->where('date_fin', '<=', $validatedData['date_fin']);
                })
                ->orWhere(function ($query) use ($validatedData) {
                    $query->where('date_debut', '<=', $validatedData['date_debut'])
                        ->where('date_fin', '>=', $validatedData['date_fin']);
                });
            })
            ->exists();

        if ($existingHoraires) {
            return redirect()->back()->with('error', 'The selected period overlaps with an existing horaire.');
        }

        $heure_ouverture = date('H:i:s', strtotime($validatedData['heure_ouverture']));
        $heure_fermeture = date('H:i:s', strtotime($validatedData['heure_fermeture']));
        // Create a new Horaire instance
        $horaire = new Horaire();
        $horaire->heure_ouverture = $heure_ouverture;
        $horaire->heure_fermeture = $heure_fermeture;
        $horaire->date_debut = $validatedData['date_debut'];
        $horaire->date_fin = $validatedData['date_fin'];
    
        // Associate the Horaire with the client
        $client->horaires()->save($horaire);

        // Redirect or perform additional actions
        return redirect()->route('admin.horaires.index', $client->id)->with('success', 'Votre Horaire Cree Avec Success ');
    }



}
