<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Imei;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
class ImeiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index()
     {
         $imeirestaurant = Imei::with('restaurant')->paginate(10);
        // $owners = User::all(); // Retrieve all owners from the database
     
        return view('admin.imei.index',compact( 'imeirestaurant'));
    }

    
   /*  public function index()
    {
        $imeirestaurant = Imei::paginate(10);


return view('admin.imei.index',compact( 'imeirestaurant'));

}
       $userId = Auth::id();
        $user = User::find($userId);
        if ($user) {
        
        $restaurant = $user->restaurant;

        $imei = Imei::where('restaurant_id', $restaurant->id)->paginate(10);
       return view('restaurant.imei.index', compact('imei'));
    }else {
        // Handle the case when the user does not have a restaurant
        // For example, you can redirect to a page or show an error message
        return redirect()->back();
    }*/

    
   /* public function index()
    {
        //public function index()
    {
        $imei = Imei::where('restaurant_id', Auth::id())->paginate(10);
        $client = Client::all();
    
        //return view('restaurant.categories.index', compact('categories', 'products'));
    
        if (Auth::user()->is_admin == 1) {
            return view('restaurant.imei.index', compact('imei', 'client'));
            
        }

    }*/
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = Client::all();
      //$imeirestaurant = Imei::all();
       // $owner = User::find(Auth::id()); // Retrieve the logged-in user
        
       return view('admin.imei.create', compact('client'));

          //  return view('admin.produits.create', compact('categories', 'familleOptions'));
        
     }
      /* $imeirestaurant = Imei::all();
        $client = Client::all();

        return view('admin.imei.create', compact('client', 'imeirestaurant'));

        $imei = Imei::paginate(10);
       return view('restaurant.imei.create', compact('imei'));*/
   

    /**
     * Store a newly created resource in storage.
     */
          public function store(Request $request)


    {
        $imeirestaurant = new Imei();

        $request->validate([
        'restaurant_id' => 'required',
        'numimei' => 'required',
        'N_Serie' => 'required',
        'Date_Service' => 'required',


    ]);

    $imeirestaurant = new Imei();
    $imeirestaurant->restaurant_id = $request->restaurant_id;

    $imeirestaurant->numimei = $request->numimei;
    $imeirestaurant->N_Serie = $request->N_Serie;
    $imeirestaurant->Date_Service = $request->Date_Service;

    $imeirestaurant->save();
    return redirect()->route('admin.imei.index')->with('success', 'code imei  ajoutée avec succès.');
}
        
    

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $imeirestaurant = Imei::findOrFail($id);
        $client = Client::all();
        return view('admin.imei.edit', compact('client','imeirestaurant'));
    }
    

    /**
     * Update the specified resource in storage.  
     */
    public function update(Request $request, $id)
    {
        
        
        $imeirestaurant = Imei::find($id);
        $request->validate([

            'numimei' => 'required',
            'N_Serie' => 'required',
            'Date_Service' => 'required',
            'restaurant_id' => 'required',

        ]);

       

    //$imeirestaurant = new Imei();
    $imeirestaurant->numimei = $request->numimei;
    $imeirestaurant->N_Serie = $request->N_Serie;
    $imeirestaurant->Date_Service = $request->Date_Service;
    $imeirestaurant->restaurant_id = $request->restaurant_id;


      
    $imeirestaurant->save();
        return redirect()->route('admin.imei.index')->with('success', 'code imei Modifier Avec succès');
    }
        
        /*$imei = Imei::find($id);

        if ($imei) {
            $imei->name = $request->input('Imei');
            $imei->name = $request->input('N_Serie');
            $imei->name = $request->input('Date_Service');

            $imei->save();

                return redirect()->route('restaurant.imei.index')->with('success', 'Imei Modifier Avec succée');

        }*/
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
    
        $imeirestaurant = Imei::findOrFail($id);
 // Delete the corresponding user
               
// Delete the client
           $imeirestaurant->delete();

        // Delete the famille option
        
        // Redirect back with success message
        return redirect()->route('admin.imei.index')->with('success', 'code imei supprimé avec succès.');
     
    }

 
}

