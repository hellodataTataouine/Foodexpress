<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class RestaurantProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
    public function edit()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {

        $restaurant = $user->restaurant;

        $client = Client::where('id', $restaurant->id)->first();

        // Pass the $client object to the view
        return view('restaurant.restaurant.edit', compact('client'));}
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {

        $restaurant = $user->restaurant;
        $client = Client::find($restaurant->id);

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


			    // Handle accueil image update
            if ($request->hasFile('imageslide')) {
                $image = $request->file('imageslide');
                $imagePath = 'uploads/';
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($imagePath), $imageName);
                $imageUrl = $imagePath . $imageName;

                // Delete the previous logo image if it exists
                if ($client->Slide_photo && Storage::exists($client->Slide_photo)) {
                    Storage::delete($client->Slide_photo);
                }

                $client->Slide_photo = $imageUrl;
            }


			  // Handle category image update
            if ($request->hasFile('imagecategory')) {
                $image = $request->file('imagecategory');
                $imagePath = 'uploads/';
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($imagePath), $imageName);
                $imageUrl = $imagePath . $imageName;

                // Delete the previous logo image if it exists
                if ($client->Category_photo && Storage::exists($client->Category_photo)) {
                    Storage::delete($client->Category_photo);
                }

                $client->Category_photo = $imageUrl;
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
    }}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
	 public function editprofile()
    {
		      $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {

        $restaurant = $user->restaurant;

       // $client = Client::where('id', $restaurant->id)->first();

        // Pass the $client object to the view
        return view('restaurant.profile.edit');}
      }

	  public function updateprofile(Request $request)
    {
		  $user = Auth::user();

    $userId = $user->id;
       /* $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId,
            'password' => 'required|min:8',
            //'password_confirmation' => 'required|min:8',
        ]);*/

        $restaurant = $user->restaurant;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
		  $user->password = Hash::make($request->input('new_password'));
        //$user->password = $request->input('new_password');
		   $user->restaurant_id = $restaurant->id;
		  $user->is_admin = 0;

        // Check if a new password is provided
       /* if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }*/
        $user->save();

        return redirect()->route('indexrestaurant')->with('success', 'votre profile est modifié avec succès!');
    }
    public function updateStatus(Request $request){

        $user = Auth::user();

        $userId = $user->id;
        $status=intval($request->input('status'));
        $restaurant = $user->restaurant;
        $rest = Client::findOrFail($restaurant->id);
        $rest->available = $status;
        $rest->save();
        if ($status === 1) {
            // Logic for Disponible
            return response()->json(['message' => 'Status updated to Disponible']);
        } elseif ($status === 0) {
            // Logic for No Disponible
            return response()->json(['message' => 'Status updated to No Disponible']);
        }

        return response()->json(['message' => 'Invalid status'], 400);

    }

}
