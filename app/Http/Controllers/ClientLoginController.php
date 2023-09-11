<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;



class ClientLoginController extends Controller
{

    public function showLoginForm(Request $request)
    {
        $subdomain = $request->getHost();
        $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
        $cart = session()->get('cart', []);
        return view('client.login',compact('subdomain','cart'));
    }
    public function showRegistrationForm()
    {
        return view('client.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
      //  dd($credentials);
        //dd(Auth::attempt($credentials));
        if (Auth::guard('clientRestaurant')->attempt($credentials)) {
            return redirect()->intended('/store');
        }

        // Authentication failed
        return redirect()->back()->withInput()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout()
    {
        Auth::guard('clientRestaurant')->logout();

        return redirect('/store');
    }
    public function register(Request $request)
    {
        $sub = $request->getHost();
        $subdomainVerif = preg_replace('/:\d+$/', '', $sub).':8000'; 
        $client = Client::where('url_platform', $subdomainVerif)->firstOrFail();
        $restaurant_id = $client->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:basic_users,email',
            'password' => 'required|min:8|confirmed',
        ]);
      $basicUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 3,
            'restaurant_id' => $restaurant_id,
        ]);

        // Handle the rest of the registration process

        return redirect()->intended('/store');
    }
}
