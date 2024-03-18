<?php

namespace App\Http\Controllers;
use App\Models\reservationTable;
use App\Models\Table;
use App\Models\CategoriesRestaurant;
use App\Models\Produits;
use App\Models\ProduitsRestaurants;
use App\Models\ProduitsFamilleOption;
use App\Models\ProduitsFOptionsrestaurant;
use App\Models\FamilleOption;
use App\Models\familleOptionsRestaurant;
use App\Models\Option;
use App\Models\ClientRestaurat;
use App\Models\Command;
use App\Models\OptionsRestaurant;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
class TablesController extends Controller
{
    public function index()
    {

       
        
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;

		$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();


       
    
      //  $client = Client::where('user_id', $userId)->firstOrFail();
        // Retrieve commandes with their related user where the restaurant_id matches the logged-in user's ID
       
    
      
        $tables = Table::where('id_restaurant', $restaurant->id)->paginate(10);
       return view('restaurant.Tables.index', compact('tables', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }}


    
    public function destroy(Table $table)
    {

        $reservations = ReservationTable::where('table_id', $table->id)->get();
        foreach( $reservations as $reservation ){
          $reservation->delete(); 
        }
        $table->delete();
        return redirect()->route('restaurant.tables.index')->with('success', 'Table supprimée avec succès.');
    }

    
    public function reservationsTable(Table $table)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
				$clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();
        $reservations = reservationsTable::where('table_id', $table->id)->where('id_restaurant', $restaurant->id)->paginate(10);
        return view('restaurant.reservations.index', compact('reservations', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
    }}
    public function create()
    {
        $tables =Table::paginate(10);
            return view('restaurant.tables.create', compact('tables'));
    }

   
    

    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
    
        if (!$user || !$user->restaurant) {
            // Handle the case when the user does not have a restaurant
            // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    
        $restaurant = $user->restaurant;

         // Retrieve the uploaded image file
         $imageFile = $request->file('url_image');
      
         // Check if an image file was uploaded
         if ($imageFile) {
             // Store the uploaded image and retrieve its URL
             $imagePath = $imageFile->store('public/images');
             $imageUrl = asset('storage/' . $imagePath);
         } elseif ($request->has('url_image')) {
             // Use the URL of the existing image
             $imageUrl = $request->input('url_image');
         } else {
             // No image provided or selected
             $imageUrl = null;
         }
        
        $table = new Table();
        $table->designation = $request->designation;
        $table->nbre_personnes = $request->nbre_personnes;
       
        $table->id_restaurant = $restaurant->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/' . $imageName;
            $image->move(public_path('uploads/'), $imageName);
		
            $table->photo = $imagePath;
        }
        $table->save();
    
        
    
        return redirect()->route('restaurant.tables.index')->with('success', 'Table ajoutée avec succès');
    }
    

    

    public function edit($id)
    {
         $table =   Table::findOrFail($id);


            return view('restaurant.tables.edit', compact('table'));


    }

    public function update(Request $request, $id)
    {
        $table = Table::find($id);

        if ($table) {

             // Handle image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'uploads/';
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($imagePath, $imageName);
            $imageUrl = $imagePath . '/' . $imageName;
    
            // Delete the previous image file if it exists
            if ($table->photo) {
                Storage::disk('public')->delete($table->photo);
            }
    
            $table->photo = $imageUrl;
        }
            $table->designation = $request->designation;
            $table->nbre_personnes = $request->nbre_personnes;
           
            $table->save();

                return redirect()->route('restaurant.tables.index')->with('success', 'Table Modifiée Avec succès');

        }

    }
   
}
