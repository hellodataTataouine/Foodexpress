<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use App\Models\Phone;



class RegistrationController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        $subdomain = $request->getHost();
        $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
        $client = Client::where('url_platform', $subdomain)->first();
        return view('client.register',compact('client'));
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'phone' => 'required',
    ]);

    $subdomain = $request->getHost();
    $subdomain = preg_replace('/:\d+$/', '', $subdomain).':8000'; 
    $client = Client::where('url_platform', $subdomain)->first();
    $user_id = $client->id;
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->is_admin = 3;
    $user->restaurant_id = $user_id;
    $user->save();

    $phoneData = [
        'phone_num' => $request->phone,
        'user_id' => $user->id,
    ];

    $phone = Phone::create($phoneData);

    return redirect()->intended('/store');
} 

}
