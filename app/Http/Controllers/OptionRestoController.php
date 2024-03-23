<?php

namespace App\Http\Controllers;
use App\Models\OptionsRestaurant;
use App\Models\familleOptionsRestaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Models\Client;
use App\Models\ClientRestaurat;
use App\Models\ProduitsRestaurants;
use App\Models\Command;


class OptionRestoController extends Controller
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
 
        $options = OptionsRestaurant::where('restaurant_id', $restaurant->id)->get();
			
			// stats
			
		$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();
			
        return view('restaurant.options.index', compact('options', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
        }else {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
 
        $familleOptions = FamilleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();;
        $selectedFamilleOption = $request->input('famille_option_id');
        return view('restaurant.options.create', compact('familleOptions', 'selectedFamilleOption'));
 
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }  }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
 
      /*  $request->validate([
           // 'famille_option_id_rest' => 'required',
            'nom_option' => 'required',
            'prix' => 'required|numeric',
        ]);*/

        $option = new OptionsRestaurant();
        $option->famille_option_id_rest = $request->input('famille_option_id');
        $option->nom_option = $request->input('nom_option');
        $option->prix = $request->input('prix');
       $option->restaurant_id = $restaurant->id;
        $option->save();
 $options = OptionsRestaurant::where('famille_option_id_rest', $request->input('famille_option_id'))->get();
        return view('restaurant.options.index', compact('options'))->with('success', 'Option ajoutée avec succès!');
        //return redirect()->route('restaurant.options.index')->with('success', 'Option ajoutée avec succès!');
  
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }   }
    public function remove(OptionsRestaurant $option)
    {
        // Perform the removal logic here
        $option->delete();

        return redirect()->back()->with('success', 'Option supprimée avec succès!');
    }
    public function edit(OptionsRestaurant $option)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        $restaurant = $user->restaurant;
        $familleOptions = familleOptionsRestaurant::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.options.edit', compact('option', 'familleOptions'));
    }else {
       
        return redirect()->back();
    }  
 }
    
    public function update(Request $request, OptionsRestaurant $option)
    {
       /* $request->validate([
            'famille_option_id_rest' => 'required',
            'nom_option' => 'required',
            'prix' => 'required|numeric',
        ]);*/
    
        $option->famille_option_id_rest = $request->input('famille_option_id');
        $option->nom_option = $request->input('nom_option');
        $option->prix = $request->input('prix');
        $option->save();
    $options = OptionsRestaurant::where('famille_option_id_rest', $request->input('famille_option_id'))->get();
        return view('restaurant.options.index', compact('options'))->with('success', 'Option modifiée avec succès!');
       // return redirect()->back()->with('success', 'Option modifiée avec succès!');
    }
    
    public function updateOptionRowN(Request $request) {
        $optionId = $request->input('optionId');
        $rowN = $request->input('rowN');
    
        // Find the category
        $option = OptionsRestaurant::find($optionId);
    
        if (!$option) {
            return response()->json(['success' => false, 'message' => 'option not found']);
        }
    
        // Update the RowN property and save
        $option->RowN = $rowN;
        $option->save();
    
        return response()->json(['success' => true, 'message' => 'RowN updated']);
    }

    public function updatestatus(Request $request)
    {
        $option_id = $request->input('option_id');
        $status = $request->input('status');

        // Assuming you have a 'products' table with a 'status' column, you can update the status like this:
        $option = OptionsRestaurant::findOrFail($option_id);
        $option->status = $status;
        $option->save();

        // You can return a response to indicate the update was successful if needed.
        return response()->json(['success' => true]);
    }

}
