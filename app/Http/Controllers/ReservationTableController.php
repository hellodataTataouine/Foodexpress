<?php

namespace App\Http\Controllers;

use App\Models\ReservationTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationTableController extends Controller
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

        $reservations = ReservationTable::where('restaurant_id', $restaurant->id)->paginate(10);
        
        return view('restaurant.reservations.index', compact('reservations'));
        }
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('restaurant.reservations.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Add validation rules for your reservation data
        $validatedData = $request->validate([
            'restaurant_id' => 'required',
            'client_id' => 'required',
            'nbre_Personnes' => 'required',
            'Heure' => 'required',
            'Date' => 'required',
        ]);

        // Create a new reservation record
        ReservationTable::create($validatedData);

        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('reservations.index');
    }

    // Display the specified resource.
    public function show(ReservationTable $reservation)
    {
        return view('restaurant.reservations.show', compact('reservation'));
    }

    // Show the form for editing the specified resource.
    public function edit(ReservationTable $reservation)
    {
        return view('restaurant.reservations.edit', compact('reservation'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, ReservationTable $reservation)
    {
        // Add validation rules for your reservation data
        $validatedData = $request->validate([
            'restaurant_id' => 'required',
            'client_id' => 'required',
            'nbre_Personnes' => 'required',
            'Heure' => 'required',
            'Date' => 'required',
        ]);

        // Update the reservation record
        $reservation->update($validatedData);

        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('restaurant.reservations.index');
    }

    // Remove the specified resource from storage.
    public function destroy(ReservationTable $reservation)
    {
        $reservation->delete();

        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('restaurant.reservations.index');
    }
}
