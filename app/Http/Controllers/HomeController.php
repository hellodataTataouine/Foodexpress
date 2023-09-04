<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::with('userProduct')->paginate(10);
        if (!Auth::user() || Auth::user()->is_admin != 1) {
            Auth::logout();
            return abort(403, 'Unauthorized');
        } else {
            return view('admin.home', compact('clients'));
        }
    }
}
