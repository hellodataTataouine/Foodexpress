<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Models\ClientPostalCode;
use App\Models\Client;

class PostalCodeController extends Controller
{
    public function validatePostalCode(Request $request)
    {
        $subdomain = $request->getHost();
        $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
        // Check if the subdomain exists in the clients table
        $idRestaurant = Client::where('url_platform', $subdomain)->value('id');
        $code = $request->input('postal_code');
        // Check if the code exists in the database
        $codeExists = ClientPostalCode::where('postal_code', $code)
        ->where('client_id', $idRestaurant)
        ->exists();
        
     if (!$codeExists) {
            $phoneNum1 = Client::where('id', $idRestaurant)->value('phoneNum1');
            
            $email = Client::where('id', $idRestaurant)->first()->user->email;
        
            session()->put('phoneNum1', $phoneNum1);
            session()->put('email', $email);
        }
        // Set the session variable based on the code validation
        session()->put('showPopup', $codeExists);
        // Redirect back to the previous page
        return redirect()->back();
    }
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
            $restaurant = $user->restaurant;
        
        }
        
        
        
        $servicezone = ClientPostalCode::where('client_id', $restaurant->id)->get();
        return view('restaurant.servicezone.index', compact('servicezone'));

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
        // $request->validate([
        //     'postal_code'=> 'required|numeric',
        //     'min_cmd'=>'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        // ]);
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
    public function edit($id)
    {
        //
        $postalcode = ClientPostalCode::findOrFail($id);
        return view('restaurant.servicezone.update', compact('postalcode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        
        $userId = Auth::id();
        $user = User::find($userId);
        // $request->validate([
        //     'postal_code'=> 'required|numeric',
        //     'min_cmd'=>'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
        // ]);
        if ($user) {
            $restaurant = $user->restaurant;
            $postalcode = ClientPostalCode::findOrFail($id);
            $postalcode->client_id = $restaurant->id;
            $postalcode->postal_code = $request->input('postal_code');
            $postalcode->min_cmd = $request->input('mincmd');
            $postalcode->save();
            
        }
        return redirect()->route('restaurant.servicezone.index')->with('success', ' Zone de service Modifiée Avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $servicezone = ClientPostalCode::findOrFail($id);
        $servicezone->delete();
        return redirect()->route('restaurant.servicezone.index')->with('danger', ' Zone de service supprimée Avec succès');
    }
    
}
