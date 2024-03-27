<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientRestaurat;
use App\Models\ReservationTable;
use App\Models\ProduitsRestaurants;
use App\Models\Table;
use App\Models\Command;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;
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
        $clientCount = ClientRestaurat::where('restaurant_id', $restaurant->id)->count();
		$produitsCount = ProduitsRestaurants::where('restaurant_id', $restaurant->id) ->count();
		$commandeCount = Command::where('restaurant_id', $restaurant->id)->count();
		$NouveauCommandeCount = Command::where('restaurant_id', $restaurant->id)
            ->where('statut', 'Nouveau')
            ->count();
      $reservations = ReservationTable::where('restaurant_id', $restaurant->id)
    ->orderBy('date', 'desc')
    ->with('tables')
    ->get();
        return view('restaurant.reservation.index', compact('reservations', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
        }
    }
    public function indexClient($subdomain)
    {
        $subdomainConfig = Config::get('subdomains.subdomains.' . $subdomain);
    
        if (!$subdomainConfig) {
            abort(404); // Handle subdomain not found
        }
        $cart = session()->get('cart', []);
       // Retrieve the client based on the subdomain configuration
       $client = Client::where('url_platform', $subdomainConfig['route_prefix'])->firstOrFail();
        return view('client.reservation', compact('subdomain', 'client', 'cart'));
        }
      

    // Show the form for creating a new resource.
    public function create()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;

        $clients = ClientRestaurat::where('restaurant_id', $restaurant->id)->get();
        $tables = Table::where('id_restaurant', $restaurant->id)->get();
        
        return view('restaurant.reservation.create', compact('clients' , 'tables'));}
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {

        $userId = Auth::id();
        $user = User::find($userId);
   
        if (!$user || !$user->restaurant) {
             // For example, you can redirect to a page or show an error message
            return redirect()->back();
        }
    
        $restaurant = $user->restaurant;
        $ReservationTable = new ReservationTable();
       
        $ReservationTable->table_id = $request->table_id;
        $ReservationTable->client_id = $request->client_id;
        $ReservationTable->nbre_personnes = $request->nbre_personnes;
        $ReservationTable->heure_debut = $request->heure_debut;
        $ReservationTable->heure_fin = $request->heure_fin;
        $ReservationTable->statut = "confirmé";
        $ReservationTable->date = $request->date; 
        $ReservationTable->restaurant_id = $restaurant->id; 
		
        $ReservationTable->save();
       
        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('restaurant.resevation.index');
    }

    public function storeClient(Request $request)
    {
       
       $subdomain = $request->getHost();
       $subdomain = preg_replace('/:\d+$/', '', $subdomain); 
       $client = Client::where('url_platform', $subdomain)->firstOrFail();
       /* if (auth()->guard('clientRestaurant')->check()){
            $userId = auth()->guard('clientRestaurant')->id();
           if ($userId) {
                $Userloggedin = ClientRestaurat::findOrFail($userId);*/
        $ReservationTable = new ReservationTable();
        
        $ReservationTable->table_id = $request->input('table_id');
        $ReservationTable->client_id = 3;
        $ReservationTable->nbre_personnes = $request->input('nbre_personnes');
        $ReservationTable->heure_debut = $request->input('heure_debut');
        $ReservationTable->heure_fin = $request->input('heure_fin');
        $ReservationTable->statut = "Nouveau";
        $ReservationTable->date = $request->input('date'); 
        $ReservationTable->restaurant_id = $client->id;  
        $ReservationTable->save();
		
	
		
       
        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('restaurant.reservation.index');
    }

    // Display the specified resource.
    public function show(ReservationTable $reservation)
    {
        return view('restaurant.reservation.show', compact('reservation'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;
         $reservation =   ReservationTable::findOrFail($id);
         $clients = ClientRestaurat::where('restaurant_id', $restaurant->id)->get();
         $tables = Table::where('id_restaurant', $restaurant->id)->get();
         
      
        return view('restaurant.reservation.edit', compact('reservation', 'clients', 'tables'));
    }}

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $reservation = ReservationTable::find($id);
		//dd($reservation);
        // Add validation rules for your reservation data
       /* $validatedData = $request->validate([
            'table_id' => 'required',
            'client_id' => 'required',
            'nbre_Personnes' => 'required',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'date' => 'required',
            'statut' => 'required',
        ]);*/

        // Update the reservation record
		$reservation->table_id = $request['table_id'];
		$reservation->client_id = $request['client_id'];
		$reservation->nbre_Personnes = $request['nbre_personnes'];
		$reservation->heure_debut = $request['heure_debut'];
		$reservation->heure_fin = $request['heure_fin'];
		$reservation->date = $request['date'];
		$reservation->statut = "confirmé";
     //  dd($reservation);
        $reservation->save();
        

        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('restaurant.resevation.index');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {

        $reservation = ReservationTable::findOrFail($id);
        $reservation->delete();

        // Redirect to the reservation index page or another appropriate location
        return redirect()->route('restaurant.resevation.index')->with('success', 'reservation supprimée avec succès.');
    }

    public function Availabletables(Request $request)
{
    $userId = Auth::id();
    $user = User::find($userId);

    if ($user) {
        $restaurant = $user->restaurant;

        // Retrieve the reservation criteria from the request
        $nbrePersonnes = $request->input('nbre_personnes');
        $heureDebut = $request->input('heure_debut');
        $heureFin = $request->input('heure_fin');
        $date = $request->input('date');

        // Check if there is any existing reservation within the specified time range
        $conflictingReservation = ReservationTable::where('date', '=', $date)
            ->where('statut', '=', 'confirmé')
            ->where(function ($query) use ($heureDebut, $heureFin) {
                $query->whereBetween('heure_debut', [$heureDebut, $heureFin])
                      ->orWhereBetween('heure_fin', [$heureDebut, $heureFin]);
            })
            ->exists();
//dd($conflictingReservation);
        // If there is a conflicting reservation, return a response indicating the conflict
        if ($conflictingReservation) {
			//dd($conflictingReservation);
            return response()->json(['message' => 'Il y a déjà une réservation dans cet intervalle horaire.'], 422);
        }

        // Query the available tables based on the criteria
        $availableTables = Table::where('nbre_Personnes', '>=', $nbrePersonnes)
            ->where('id_restaurant', '=', $restaurant->id)
            ->select('id', 'designation', 'photo', 'nbre_personnes')
            ->get();

        // Return the list of available tables as JSON response
        return response()->json($availableTables);
    }
}
	
	
	
	
      public function updateStatus(Request $request)
{
    // Get the command ID and new status from the request
    $reservationId = $request->input('commandId');
    $newStatus = $request->input('newStatus');


    $Reservation = ReservationTable::findOrFail($reservationId);


   
        
    if ($Reservation) {

		
		
        $Reservation->statut = $newStatus;
        $Reservation->save();
		
		 $userId = Auth::id();
        $user = User::find($userId);
        if ($user && $Reservation->ClientEmail) {
       
        $restaurant = $user->restaurant;
				/*  $commandes = ReservationTable::with(['user','cartDetails', 'cartDetails.produit'])
            ->where('restaurant_id', $restaurant->id)
            ->get();*/
		
		
		
		$data = [
    'clientFirstName' => $Reservation->ClientFName,
    'clientLastName' => $Reservation->ClientLName,
	'clientNum1' => $Reservation->ClientPhone,
	'clientAdresse' => "",
    'reservationId' => $Reservation->id,
    'currentDateTime' => now()->format('d/m/Y H:i'),
   
   
    'clientEmail' => $Reservation->ClientEmail,
     
	'status' => $Reservation->statut,
			'restaurant' => $restaurant->name,
];
	
		
		$subject = 'Confirmation de réservation';
// Store the email in the session
if($Reservation->statut == "confirmé"){
// Send the email using the Blade view
Mail::send('orderEmail_update_statusReservation', $data, function ($message) use ($subject, $data, $user) {
    $message->subject($subject)
        ->to($data['clientEmail']);
    $message->from($user->email,$user->name);
});
		
}	}
        return response()->json(['message' => 'reservation modifiée', 'data' => $data]);
       
    } else {
        return response()->json(['message' => 'Statut modifié avec succès']);
    }


}

}
