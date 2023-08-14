<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Command;

use App\Models\User;
use App\Models\CarteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubDomain extends Controller
{
    public function index()
    {
        $clients = Client::with('userProduct')->paginate(10);

        // Check if the user is not an admin (is_admin == 0)
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
    
        $client = Client::where('user_id', $userId)->firstOrFail();
        // Retrieve commandes with their related user where the restaurant_id matches the logged-in user's ID
        $commandes = Command::with(['user','cartDetails', 'cartDetails.produit'])
            ->where('restaurant_id', $client->id)
            ->paginate(10);
    
        if (!Auth::user() || Auth::user()->is_admin !== 0) {
            Auth::logout();
            return abort(403, 'Unauthorized');
        }
    
        return view('restaurant.home', compact('commandes'));
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

            return redirect()->back()->with('success', 'Password changed successfully.');
        } else {
            return redirect()->back()->withErrors(['current-password' => 'Invalid current password.']);
        }
    }
}
