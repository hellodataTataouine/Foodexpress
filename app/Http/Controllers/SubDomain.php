<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientRestaurat;
use App\Models\ProduitsRestaurants;
use App\Models\Command;
use App\Models\User;
use App\Models\CarteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class SubDomain extends Controller
{
    public // Check if the user is not an admin (is_admin == 0)
  function index()
    {
        $clients = Client::with('userProduct')->paginate(10);

              if (!Auth::user() || Auth::user()->is_admin === 3) {
            Auth::logout();
            return abort(403, 'Unauthorized');
        } elseif (Auth::user()->is_admin === 0) {
            return view('restaurant.home', compact('clients'));
        }

        return view('admin.home', compact('clients'));
    }
    public function getUsers()
    {
        $users = User::with('restaurant')->where('is_admin', 0)->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function restaurantIndex()
    {
  // Get the ID of the logged-in user
      
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
        $commandes = Command::with(['user','cartDetails', 'cartDetails.produit'])
            ->where('restaurant_id', $restaurant->id)
            ->get();
    
        if (!Auth::user() || Auth::user()->is_admin !== 0) {
            Auth::logout();
            return abort(403, 'Unauthorized');
        }
    
        return view('restaurant.home', compact('commandes', 'clientCount','commandeCount', 'NouveauCommandeCount', 'produitsCount'));
    }}


    public function updateStatus(Request $request)
{
    // Get the command ID and new status from the request
    $commandId = $request->input('commandId');
    $newStatus = $request->input('newStatus');


    $Command = Command::findOrFail($commandId);


   
        
    if ($Command) {

		
		
        $Command->Statut = $newStatus;
        $Command->save();
		
		 $userId = Auth::id();
        $user = User::find($userId);
        if ($user && $Command->clientEmail  && $Command->Statut =="Livrée" ) {
       
        $restaurant = $user->restaurant;
				  $commandes = Command::with(['user','cartDetails', 'cartDetails.produit'])
            ->where('restaurant_id', $restaurant->id)
            ->get();
		
		
		
		$data = [
    'clientFirstName' => $Command->clientfirstname,
    'clientLastName' => $Command->clientlastname,
	'clientNum1' => $Command->clientNum1,
	'clientAdresse' => $Command->clientAdresse,
    'commandId' => $Command->id,
    'currentDateTime' => now()->format('d/m/Y H:i'),
   
    'totalPrice' => $Command->prix_total,
    'clientEmail' => $Command->clientEmail,
     
	'status' => $Command->Statut,
];
	
		
		$subject = 'Confirmation de commande';
// Store the email in the session

// Send the email using the Blade view
Mail::send('orderEmail_update_status', $data, function ($message) use ($subject, $data) {
    $message->subject($subject)
        ->to($data['clientEmail']);
});
		
		}
        return response()->json(['message' => 'Commande modifiée', 'data' => $data]);
       
    } else {
        return response()->json(['message' => 'Statut modifié avec succès']);
    }


}
	
	 public function destroy($id)
    {
        $command = Command::findOrFail($id);
    // Delete the associated image file if it exists
    $command->delete();
    
       return redirect()->back()->with('success', 'Commande Supprimée avec succès.');
    
    }
	
    public function showAdmin()
    {
        return view('admin.home', [
            'subdomain' => Client::all()
        ]);
    }

    public function show(Client $client)
    {
        return view('admin.subdomain', [
            'subdomain' => $client
        ]);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->status = $request->input('status');
        $client->save();

        return redirect()->back();
    }

    public function showChangePasswordFormAdmin()
    {
        return view('admin.parametres.change-password');
    }

    public function changePasswordAdmin(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->input('current-password'), $user->password)) {
            $user->password = Hash::make($request->input('new-password'));
            $user->save();

            return redirect()->back()->with('success', 'Password modifié avec succès.');
        } else {
            return redirect()->back()->withErrors(['current-password' => 'Invalid current password.']);
        }
    }
}
