<?php

namespace App\Http\Controllers;

use App\Models\ClientPostalCode;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ServiceZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Auth::id();
        $user = User::find($userId);
        
        if($user){
            $restaurant = $user->restaurant;
            $servicezone = ClientPostalCode::whereclient_id($restaurant->id)->get();
        }
        
        return view ('restaurant.servicezone.index', compact('servicezone'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('restaurant.servicezone.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userId = Auth::id();
        $user = User::find($userId);
        $servicezone = new ClientPostalCode;
        $request->validate([
            'postal_code'=> 'required|numeric',
            'min_cmd'=>'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        ]);
        if ($user) {
            $restaurant = $user->restaurant;
            $servicezone->client_id = $restaurant->id;
            $servicezone->postal_code = $request->input('postal_code');
            $servicezone->min_cmd = $request->input ('mincmd');
            $servicezone->save();
        }
        return redirect()->route('restaurant.servicezone.index')->with('success', ' Zone de service creé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $servicezone = ClientPostalCode::findOrFail($id);
        return view ('restaurant.servicezone.update', compact ('servicezone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $userId = Auth::id();
        $user = User::find($userId);
        $servicezone = new ClientPostalCode;
        $request->validate([
            'postal_code'=> 'required|numeric',
            'min_cmd'=>'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        ]);
        if ($user){
            $restaurant = $user->restaurant;
            $servicezone = ClientPostalCode::findOrFail($id);
            $servicezone->postal_code = $request->input('postal_code');
            $servicezone->min_cmd = $request->input ('mincmd');
            $servicezone->save();
        }
        return redirect()->route('restaurant.servicezone.index')->with('success', ' Zone de service modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $servicezone = ClientPostalCode::findOrFail($id);
        $servicezone->delete();
    }
}
