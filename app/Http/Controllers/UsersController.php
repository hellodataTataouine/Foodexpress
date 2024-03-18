<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user() || Auth::user()->is_admin === 0) {

        $users = User::with('restaurant')->where('is_admin', 0)->paginate(10);
        return view('admin.users.index', compact('users'));
      
      
        /* if (Auth::user()->is_admin == 1) {
            $users = User::with('restaurant')->paginate(10);
            return view('admin.users.index', compact('users'));
        } else {
            $restaurantId = Auth::user()->restaurant_id;
            $users = User::where('restaurant_id', $restaurantId)->paginate(10);
            return view('restaurant.users.index', compact('users'));*/
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // Get the list of countries
        $restaurant = Client::all();
        
        // Load the add view and pass the list of countries to the view
        return view('admin.users.create', compact('restaurant'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'restaurant_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
       
        ]);

        $input = $request->all();
        User::create($input);
       
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès!');
       }

   
       public function edit($id)
       {
           $user = User::findOrFail($id);
           $restaurants = Client::all();
           
           return view('admin.users.edit', compact('user', 'restaurants'));
       }
       

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'restaurant_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|min:8',
            //'password_confirmation' => 'required|min:8',
        ]);
    
        $user = User::findOrFail($id);
        $user->restaurant_id = $request->input('restaurant_id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
		
        $user->password = Hash::make($request->input('password'));
		 
		  $user->is_admin = 0;
        // Check if a new password is provided
       /* if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }*/
        $user->save();
    
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('flash_message', 'User deleted!');
    
    }
    public function checkUniqueness(Request $request)
    {
        // Retrieve the values from the request
        $email = $request->input('email');
       // $username = $request->input('username');

        $existingUser =User::where('email', $email)
        ->first();

      // Return a response indicating the uniqueness status
      if ($existingUser) {
        return response()->json(['status' => 'not-unique']);
    } else {
        return response()->json(['status' => 'unique']);
    }
    }
}
