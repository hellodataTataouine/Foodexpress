<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illumniate\Request;
use App\Models\Client;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;



class AcceuilController extends Controller
{

    public function index()
    {
        $clients = Client::with('userProduct')->paginate(10);
        return view('acceuil.index', compact('clients'));
    }
    


}
