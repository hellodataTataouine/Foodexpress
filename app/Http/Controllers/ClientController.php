<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Client;
use App\Models\User;
use App\Models\Horaire;
use App\Models\ClientPostalCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\JourFerier;
use Illuminate\Support\Facades\Storage;


class ClientController extends BaseController
{


    public function index($subdomain)
    {
        $client = Client::where('url_platform', strtolower($subdomain . '.localhost:8000'))->firstOrFail();
        if ($client->status != 1) {
            abort(404);
        }
        $clients = Client::where('url_platform', $client->url_platform)->get();
        return view('admin.clients.index', compact('client', 'clients'));
    }

    public function clientsRestaurant()
    {
        $userId = Auth::id(); // Get the ID of the logged-in user
        $users = User::where('restaurant_id', function ($query) use ($userId) {
            $query->select('id')
                ->from('clients')
                ->where('user_id', $userId);
        })->paginate(10);
    
        return view('restaurant.clients.index', compact('users'));
    }

    

    public function clients()
    {
        $clients = Client::paginate(10); // Fetch the clients data with pagination, assuming you have 10 clients per page

        return view('admin.clients.index', compact('clients'));
    }
    public function create()
    {
        $client = new Client();
        return view('admin.clients.create');
    }
    public function store(Request $request)
{
     $request->validate([
        'name' => 'required|unique:clients',
        'phoneNum1' => 'required|unique:clients',
        'phoneNum2' => 'unique:clients',
         'localisation' => 'required',
         'N_Siret' => 'required|unique:clients',
         'N_Tva' => 'required|unique:clients',
      
         'email' => 'required|email|unique:users',
         'password' => 'required|min:8',
         'horaires.*.date_debut' => 'required|date',
         'horaires.*.date_fin' => 'required|date',
         'horaires.*.heure_ouverture' => 'required',
         'horaires.*.heure_fermeture' => 'required',
         'postal_codes' => 'required|array',
         'postal_codes.*' => 'required',
         'joursferiers' => 'required|array',
         'joursferiers.*' => 'required',
     ]);

    ///
    // Retrieve the uploaded image file
   $imageFile = $request->file('url_image');

    // Check if an image file was uploaded
    if ($imageFile) {
        // Store the uploaded image and retrieve its URL
        
            $imagePath = 'uploads/';
            $imageName = uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path($imagePath), $imageName);
            $imageUrl = $imagePath . $imageName;




       
    }  else {
        // No image provided or selected
        $imageUrl = null;
    }
   
    // Create the client
    $client = Client::create([
        'name' => $request->name,
        'phoneNum1' => $request->phoneNum1,
        'phoneNum2' => $request->phoneNum2,
        'localisation' => $request->localisation,
        'logo' => $imageUrl,
        'url_platform' => $request->name . '.localhost:8000',
        'date' => date('Y-m-d H:i:s'),
        'status' => '1',
        'N_Siret' => $request->N_Siret,
        'N_Tva' => $request->N_Tva,
       
    ]);

 // Create the corresponding user
 $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'restaurant_id' => $client->id,
]);


    // Assign the user to the client
    $client->user_id = $user->id;
    $client->save();

    // Create horaires
    $horaires = $request->input('horaires');
    foreach ($horaires as $horaire) {
        $newHoraire = Horaire::create([
            'client_id' => $client->id,
            'date_debut' => $horaire['date_debut'],
            'date_fin' => $horaire['date_fin'],
            'heure_ouverture' => $horaire['heure_ouverture'],
            'heure_fermeture' => $horaire['heure_fermeture'],
        ]);
    }

    // Create jours  feriers
    $joursFeriers = $request->joursferiers;
    foreach ($joursFeriers as $jourFerier) {
        $newJourFerier = JourFerier::create([
            'client_id' => $client->id,
            'jour' => $jourFerier,
        ]);
    }

    // Create postal codes
    $postalCodes = $request->postal_codes;
    foreach ($postalCodes as $postalCode) {
        $newPostalCode = ClientPostalCode::create([
            'client_id' => $client->id,
            'postal_code' => $postalCode,
        ]);
    }




    return redirect('/admin')->with('succès', 'Restaurant client ajouté avec succès.');
}

   
   
    public function destroy($id)
    {
        // Find the client by ID
        $client = Client::findOrFail($id);

        // Delete the corresponding user
        if ($client->user) {
            $client->user->delete();
        }

        // Delete the client
        $client->delete();

        return redirect()->route('admin.clients')->with('succès', 'Client et utilisateur associé supprimés avec succès');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        // Pass the $client object to the view
        return view('admin.clients.edit', compact('client'));
        
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
    
        if ($client) {
            // Handle logo image update
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = 'uploads/';
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($imagePath), $imageName);
                $imageUrl = $imagePath . $imageName;
    
                // Delete the previous logo image if it exists
                if ($client->logo && Storage::exists($client->logo)) {
                    Storage::delete($client->logo);
                }
    
                $client->logo = $imageUrl;
            }
    
            $client->name = $request->input('name');
            $client->phoneNum1 = $request->input('phoneNum1');
            $client->phoneNum2 = $request->input('phoneNum2');
            $client->localisation = $request->input('localisation');
            $client->N_Siret = $request->input('N_Siret');
            $client->N_Tva = $request->input('N_Tva');

           // $client->email = $request->input('email');
           // $client->password = Hash::make($request->input('password'));
            $client->save();
    
            // Update postal codes
            $postalCodes = $request->input('postal_codes');
            if (!empty($postalCodes) && is_array($postalCodes)) {
                $client->postalCodes()->delete(); // Remove existing postal codes
                foreach ($postalCodes as $postalCode) {
                    $client->postalCodes()->create([
                        'postal_code' => $postalCode,
                    ]);
                }
            }
    
            // Update horaires
            $horaires = $request->input('horaires');
            if (!empty($horaires) && is_array($horaires)) {
                $client->horaires()->delete(); // Remove existing horaires
                foreach ($horaires as $horaire) {
                    $client->horaires()->create([
                        'date_debut' => $horaire['date_debut'],
                        'date_fin' => $horaire['date_fin'],
                        'heure_ouverture' => $horaire['heure_ouverture'],
                        'heure_fermeture' => $horaire['heure_fermeture'],
                    ]);
                }
            }
    
            // Update jours fériés
            $joursFeriers = $request->input('joursferiers');
            if (!empty($joursFeriers) && is_array($joursFeriers)) {
                $client->jourFeriers()->delete(); // Remove existing jours fériés
                foreach ($joursFeriers as $jourFerier) {
                    $client->jourFeriers()->create([
                        'jour' => $jourFerier,
                    ]);
                }
            }
    
            return redirect()->back()->with('succès', 'Informations sur le restaurant mises à jour avec succès.');
        } else {
            return redirect()->back()->with('erreur', 'Resto introuvable.');
        }
    }
    
    

    // Generate a unique URL based on the given name
    private function generateUniqueUrl($name)
    {
        $baseDomain = 'localhost:8000';
        $url = strtolower(str_replace(' ', '', $name));
        $suffix = '';
        $counter = 1;

        while (Client::where('url_platform', $url . $suffix)->exists()) {
            $suffix = $counter;
            $counter++;
        }

        return $url . $suffix . '.' . $baseDomain;
    }



    public function checkUniqueness(Request $request)
    {
        // Retrieve the values from the request
        $name = $request->input('name');
        $phoneNum1 = $request->input('phoneNum1');
        $phoneNum2 = $request->input('phoneNum2');

        $existingClient = Client::where('name', $name)
        ->orWhere('phoneNum1', $phoneNum1)
        ->orWhere('phoneNum2', $phoneNum2)
        ->first();

      // Return a response indicating the uniqueness status
      if ($existingClient) {
        return response()->json(['status' => 'not-unique']);
    } else {
        return response()->json(['status' => 'unique']);
    }
    }


    public function updateStatus(Request $request, $clientInfo)
    {
        
        $client = Client::findOrFail( $clientInfo);

        // Toggle the status
        $client->status = !$client->status;

        // Save the product to the database
        $client->save();

        return response()->json(['newStatus' => $client->status]);
    }

}
