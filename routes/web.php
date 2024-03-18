<?php

use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientStoreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoriesRestaurantController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ProduitsRestoController;
use App\Http\Controllers\HoraireController;
use App\Http\Middleware\CheckSubdomain;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AcceuilController;
use App\Http\Controllers\ClientLoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FamilleOptionController;
use App\Http\Controllers\FamilleOptionControllerResto;
use App\Http\Controllers\FamilleOptionRestoController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OptionRestoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SubDomain;
use App\Http\Controllers\PaimentMethodController;
use App\Http\Controllers\PaimentRestaurantController;
use App\Http\Controllers\LivraisonMethodController;
use App\Http\Controllers\LivraisonRestaurantController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ImeiController;

use App\Http\Controllers\ClientRestaurantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationTableController;   
use App\Http\Controllers\TablesController;
use App\Http\Controllers\RestaurantProfileController;
use App\Http\Controllers\ContactController;
use Laravel\Socialite\Facades\Socialite; 

use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\MentionsLegalesController;
use App\Http\Controllers\StripePaymentController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//for subdomain
Route::domain('{subdomain}.localhost')->group(function () {
	//Route::get('/mentions-legales', function () {
    //return view('client.mentions-legales');
//});
	//Route::get('/contact', function () {
   // return view('client.contact');
// });
	Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');
	Route::get('/politique-de-cookies',[CookiePolicyController::class, 'show'])->name('cookie.policy');
		Route::get('/mentions-legales',[MentionsLegalesController::class, 'show'])->name('mentions.legales');


	
	//Route::get('/politique-de-cookies', function () {
    //return view('client.politique-de-cookies');
//});
    Route::get('/store', [ProductsController::class, 'index'])->name('client.products.index');
    Route::get('/panier/add/{productId}', [ClientStoreController::class, 'addToCart'])->name('panier.add');
    Route::get('/panier', [ClientStoreController::class, 'index'])->name('panier.show');
    Route::delete('panier/remove/{productId}', [ClientStoreController::class, 'removeFromCart'])->name('panier.remove');
    Route::post('/panier/confirm', [ClientStoreController::class, 'confirmPanier'])->name('panier.confirm');
    Route::get('/panier/confirmation', function () {
        return view('client.panier_confirmation');
    })->name('panier.confirmation');
    Route::get('/commandes', [CommandController::class, 'commandes'])->name('client.commandes');

  	
   // Route::put('/cancel-commande/{id}', [CommandController::class, 'cancelCommande'])->name('client.commande.cancel');
   Route::put('/cancel-commande/{id}', [CommandController::class, 'cancelCommande'])
   ->name('client.commande.cancel');


   // Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/add-to-cart', [CommandController::class, 'addToCart'])->name('cart.add');
	 Route::post('/update-cart', [CommandController::class, 'editCart'])->name('cart.edit');
    Route::post('/cart/remove', [CommandController::class, 'removeCartItem'])->name('remove.CartItem');

    Route::get('/cart-items', [CommandController::class, 'getCartItems'])->name('cart.items');
    
    Route::post('/update-quantity', [CommandController::class, 'updateQuantity'])->name('update.quantity');
    
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/fetch-cart', [CommandController::class, 'fetchCart'])->name('cart.fetch');
   // Route::get('/fetch-cart', [CartController::class, 'fetchCart'])->name('cart.fetch');
    Route::get('/checkout', [CommandController::class, 'checkout'])->name('client.checkout');
   Route::match(['get', 'post'], '/checkout1', [CommandController::class, 'store'])->name('client.checkout1.store');

    Route::post('/register-and-checkout', [CommandController::class, 'registerAndCheckout'])->name('client.registerAndCheckout');

    Route::get('/panier/getProductDetails/{productId}', [ClientStoreController::class, 'getProductDetails']) ->name('panier.getProductDetails');
    Route::get('/panier/getProductRestaurantDetails/{productId}', [ClientStoreController::class, 'getProductRestaurantDetails'])->name('panier.getProductRestaurantDetails');
    Route::post('/validate-postal-code', [PostalCodeController::class, 'validatePostalCode'])->middleware('validatePostalCode')->name('validate.postal.code');
    Route::get('/restaurant/home', [App\Http\Controllers\SubDomain::class, 'restaurantIndex'])->name('indexrestaurant');
  Route::get('/client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
    Route::prefix('paypal')->group(function () {
        //Route::view('payment', 'paypal.index')->name('create.payment');
        Route::get('/handle-payment/{paymentMethodId}', [PaymentController::class, 'handlePayment'])->name('make.payment');
        Route::get('cancel-payment', [PaymentController::class, 'paymentCancel'])->name('cancel.payment');
        Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('success.payment');
		Route::get('createTransaction', [PaymentController::class, 'createTransaction'])->name('createTransaction');
    });
	   Route::get('/client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
    Route::post('/client/login', [ClientLoginController::class, 'login'])->name('client.login.submit');
    Route::post('logout', [ClientLoginController::class, 'logout'])->name('client.logout');
    
    Route::get('/client/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/client/register', [RegistrationController::class, 'register'])->name('register.submit');
   // Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');

   Route::get('/reservationtables', [ReservationTableController::class, 'indexClient'])->name('index');
    Route::post('/reservationtables', [ReservationTableController::class, 'storeClient'])->name('reservation.client.store');
    Route::get('/restaurant/reservation/fetchTables', [ReservationTableController::class, 'Availabletables'])->name('reservation.client.fetch');
 

   // Route::get('/edit-profile', [RegistrationController::class, 'editProfile'])->name('editProfile');
// Route::put('/update-profile', [RegistrationController::class, 'updateProfile'])->name('updateProfile');
// Google Sign-In
Route::get('/register/google', [RegistrationController::class, 'redirectToGoogle'])->name('register.google');

Route::get('/register/google/callback', [RegistrationController::class, 'handleGoogleCallback']);
Route::get('/login/google/callback', [RegistrationController::class, 'handleGoogleCallback'])->name('login.google.callback');
Route::get('/edit-profile', [RegistrationController::class, 'editProfile'])->name('editProfile');
Route::put('/update-profile', [RegistrationController::class, 'updateProfile'])->name('updateProfile');
	Route::controller(StripePaymentController::class)->group(function () {
    Route::get('paiement-carte-bancaire', 'stripe')->name('stripe'); // Define the named route here
    Route::post('paiement-carte-bancaire/{paymentMethodId}', 'stripePost')->name('stripe.post');
});
});


//Route::middleware(['auth:clientRestaurant'])->group(function () {
//    Route::get('/edit-profile', 'RegistrationController@editProfile')->name('client.edit_profile');
 //   Route::put('/update-profile', 'RegistrationController@updateProfile')->name('client.update_profile');
// });



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return redirect("http://" . env('mainhost') ."/admin/home");
        } else {
            session()->flush(); // Destroy the session
            abort(403, 'Unauthorized');
        }
    });
     Route::get('/home', [ClientController::class, 'clients'])->name('indexAdmin');
     Route::get('/admin/home', [ClientController::class, 'clients'])->name('indexAdmin');

     Route::get('/admin/clients/create', [ClientController::class, 'create']);
     Route::post('/admin/clients', [ClientController::class, 'store'])->name('admin.clients.store');
     Route::get('/admin/clients', [ClientController::class, 'clients'])->name('admin.clients');
     Route::put('/admin/clients/{id}', [ClientController::class, 'update'])->name('admin.clients.update');
     Route::match(['get', 'put'],'/admin/clients/{id}/edit', [ClientController::class, 'edit'])->name('admin.clients.edit');
     Route::delete('/admin/clients/{id}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');
     Route::post('/admin/client/check-uniqueness', [ClientController::class, 'checkUniqueness'])->name('check.uniqueness');
     Route::post('/admin/client/{clientInfo}/updateStatus', [ClientController::class, 'updateStatus'])->name('admin.clients.updateStatus');

     Route::get('/admin/clients/{id}/horaires', [HoraireController::class, 'index'])->name('admin.horaires.index');
     Route::post('/admin/horaires/{id}', [HoraireController::class, 'store'])->name('admin.horaires.store');

     Route::match(['get', 'post'], '/admin/login', [LoginController::class, 'login'])->name('login');
     Route::match(['get', 'post'], '/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


     Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users.index');
     Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
     Route::post('/admin/users', [UsersController::class, 'store'])->name('admin.users.store');
     Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
     Route::get('/admin/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
     Route::put('/admin/users/{user}', [UsersController::class, 'update'])->name('admin.users.update');
     Route::post('/admin/user/check-uniqueness', [UsersController::class, 'checkUniqueness'])->name('check.uniqueness.user');



     Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');
     Route::get('/admin/categories/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
     Route::post('/admin/categories', [CategoriesController::class, 'store'])->name('admin.categories.store');
     Route::delete('/admin/categories/{category}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');
     Route::get('/admin/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
     Route::put('/admin/categories/{category}', [CategoriesController::class, 'update'])->name('admin.categories.update');

     Route::get('/admin/produits', [ProduitsController::class, 'index'])->name('admin.produits.index');
     Route::get('/admin/produits/create', [ProduitsController::class, 'create'])->name('admin.produits.create');
     Route::post('/admin/produits', [ProduitsController::class, 'store'])->name('admin.produits.store');
     Route::get('/admin/produits/{produit}/edit', [ProduitsController::class, 'edit'])->name('admin.produits.edit');
     Route::put('/admin/produits/{produit}', [ProduitsController::class, 'update'])->name('admin.produits.update');
     Route::delete('/admin/produits/{produit}', [ProduitsController::class, 'destroy'])->name('admin.produits.destroy');
     Route::get('/admin/produits/{id}', [ProduitsController::class, 'show'])->name('admin.produits.show');

     Route::get('produits/{produitId}/options/{optionId}', [ProduitsController::class, 'removeOption'])->name('admin.removeOption');
     Route::post('/admin/produits/get-options-by-famille-options', [ProduitsController::class, 'getOptionsByFamilleOptions'])->name('admin.getOptionsByFamilleOptions');
     Route::post('/admin/update-status', [ProduitsController::class, 'updateStatus'])->name('admin.update-status');

     Route::get('/admin/famille-options', [FamilleOptionController::class, 'index'])->name('admin.famille-options.index');
     Route::get('/admin/famille-options/create', [FamilleOptionController::class, 'create'])->name('admin.famille-options.create');
     Route::post('/admin/famille-options', [FamilleOptionController::class, 'store'])->name('admin.famille-options.store');
     Route::get('/admin/famille-options/{id}/edit', [FamilleOptionController::class, 'edit'])->name('admin.famille-options.edit');
     Route::delete('/admin/famille-options/{id}', [FamilleOptionController::class, 'destroy'])->name('admin.famille-options.destroy');
     Route::put('/admin/famille-options/{id}', [FamilleOptionController::class, 'update'])->name('admin.famille-options.update');

     Route::get('/admin/options', [OptionController::class, 'index'])->name('admin.options.index');
     Route::get('/admin/options/create', [OptionController::class, 'create'])->name('admin.options.create');
     Route::post('/admin/options', [OptionController::class, 'store'])->name('admin.options.store');
     Route::get('/admin/options/{option}/edit', [OptionController::class, 'edit'])->name('admin.options.edit');
     Route::delete('/admin/options/{id}', [OptionController::class, 'destroy'])->name('admin.options.destroy');
     Route::put('/admin/options/{option}', [OptionController::class, 'update'])->name('admin.options.update');
     Route::get('admin/famille-options/{familleOption}', [FamilleOptionController::class, 'show'])->name('admin.famille-options.show');

     Route::get('/admin/options/remove/{option}', [OptionController::class, 'remove'])->name('admin.options.remove');

     Route::get('/admin/users', [SubDomain::class, 'getUsers'])->name('admin.users.index');

     Route::get('/admin/paiment-methods', [PaimentMethodController::class, 'index'])->name('admin.paiment.index');
     Route::get('/admin/paiment-methods/create', [PaimentMethodController::class, 'create'])->name('admin.paiment.create');
     Route::get('/admin/paiment-methods/createresto/{paimentMethod_id}', [PaimentMethodController::class, 'createresto'])->name('admin.paiment.createresto');
    
  
     Route::get('/admin/paiment-methods/{id}/edit', [PaimentMethodController::class, 'edit'])->name('admin.paiment.edit');
     Route::put('/admin/paiment-methods/{id}', [PaimentMethodController::class, 'update'])->name('admin.paiment.update');
     Route::delete('/admin/paiment-methods/{id}', [PaimentMethodController::class, 'destroy'])->name('admin.paiment.destroy');
      Route::post('/admin/paiment-methods', [PaimentMethodController::class, 'store'])->name('admin.paiment.store');
     Route::get('/admin/paiment-restaurants', [PaimentRestaurantController::class, 'index'])->name('admin.restaurant.paiment.index');
     Route::get('/admin/paiment-restaurants/create', [PaimentRestaurantController::class, 'create'])->name('admin.restaurant.paiment.create');
     Route::post('/admin/paiment-restaurants', [PaimentRestaurantController::class, 'store'])->name('admin.restaurant.paiment.store');
     Route::get('/admin/paiment-restaurants/{id}/edit', [PaimentRestaurantController::class, 'edit'])->name('admin.restaurant.paiment.edit');
    
     Route::delete('/admin/paiment-restaurants/{id}', [PaimentRestaurantController::class, 'destroy'])->name('admin.restaurant.paiment.destroy');

     Route::get('/admin/livraisonmethods', [LivraisonMethodController::class, 'index'])->name('admin.livraison.index');
     Route::get('/admin/livraisonmethods/create', [LivraisonMethodController::class, 'create'])->name('admin.livraison.create');
     Route::post('/admin/livraisonmethods', [LivraisonMethodController::class, 'store'])->name('admin.livraison.store');
     Route::get('/admin/livraisonmethods/{id}/edit', [LivraisonMethodController::class, 'edit'])->name('admin.livraison.edit');
     Route::put('/admin/livraisonmethods/{id}', [LivraisonMethodController::class, 'update'])->name('admin.livraison.update');
     Route::delete('/admin/livraisonmethods/{id}', [LivraisonMethodController::class, 'destroy'])->name('admin.livraison.destroy');



     Route::get('/admin/Imei', [ImeiController::class, 'index'])->name('admin.imei.index');
     Route::get('/admin/Imei/create', [ImeiController::class, 'create'])->name('admin.imei.create');
     Route::post('/admin/Imei', [ImeiController::class, 'store'])->name('admin.imei.store');
     Route::get('/admin/Imei/{id}/edit', [ImeiController::class, 'edit'])->name('admin.imei.edit');
     Route::put('/admin/Imei/{id}', [ImeiController::class, 'update'])->name('admin.imei.update');
     Route::delete('/admin/Imei/{id}', [ImeiController::class, 'destroy'])->name('admin.imei.destroy');
     
     Route::get('/livraisonrestaurants', [LivraisonRestaurantController::class, 'index'])->name('admin.restaurant.livraison.index');
     Route::get('/livraisonrestaurants/create', [LivraisonRestaurantController::class, 'create'])->name('admin.restaurant.livraison.create');
     Route::post('/livraisonrestaurants', [LivraisonRestaurantController::class, 'store'])->name('admin.restaurant.livraison.store');
     Route::get('/livraisonrestaurants/{id}/edit', [LivraisonRestaurantController::class, 'edit'])->name('admin.restaurant.livraison.edit');
     Route::post('/livraisonrestaurants/{id}', [LivraisonRestaurantController::class, 'update'])->name('admin.restaurant.livraison.update');
     Route::delete('/livraisonrestaurants/{id}', [LivraisonRestaurantController::class, 'destroy'])->name('admin.restaurant.livraison.destroy');
     Route::get('/admin/livraisonrestaurants/{restaurant}/details', [LivraisonRestaurantController::class, 'showDetails'])->name('admin.restaurants.details');

     Route::get('/parametres/changementMdp', [SubDomain::class, 'showChangePasswordFormAdmin'])->name('admin.parametres.change-password');
     Route::post('/parametres/changementMdp', [SubDomain::class, 'changePasswordAdmin'])->name('admin.parametres.change-password.update');
     
     Auth::routes();
    
});
Route::group(['middleware' => 'check.subdomain'], function () {


    Route::get('/restaurant', [App\Http\Controllers\SubDomain::class, 'restaurantIndex']);
    Route::get('/home', [App\Http\Controllers\SubDomain::class, 'restaurantIndex'])->name('indexrestaurant');
    Route::get('/restaurant/home', [App\Http\Controllers\SubDomain::class, 'restaurantIndex'])->name('indexrestaurant');
   
    Route::get('/clients', [ClientRestaurantController::class, 'index'])->name('restaurant.clients.index');
Route::get('/clients/create', [ClientRestaurantController::class, 'create'])->name('restaurant.clients.create');
Route::post('/clients', [ClientRestaurantController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}', [ClientRestaurantController::class, 'show'])->name('clients.show');
Route::get('/clients/{client}/edit', [ClientRestaurantController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientRestaurantController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientRestaurantController::class, 'destroy'])->name('clients.destroy');
Route::post('/updateCommande/status', [App\Http\Controllers\SubDomain::class, 'updateStatus'])->name('update.status');
 Route::delete('/restaurant/commandes/{id}', [App\Http\Controllers\SubDomain::class, 'destroy'])->name('restaurant.commandes.destroy');
   

     Route::match(['get', 'post'], '/restaurant/login', [LoginController::class, 'login'])->name('restaurant.login');

     Route::match(['get', 'post'], '/restaurant/logout', [AuthController::class, 'logout'])->name('restaurant.logout');

     Route::get('/restaurant/categories', [CategoriesRestaurantController::class, 'index'])->name('restaurant.categories.index');
     Route::get('/restaurant/categories/all', [CategoriesRestaurantController::class, 'indexResto'])->name('restaurant.categories.all');
     Route::get('/restaurant/categories/fetch-products', [CategoriesRestaurantController::class, 'fetchProducts'])->name('fetch.products');
     Route::get('/restaurant/categories/create', [CategoriesRestaurantController::class, 'create'])->name('restaurant.categories.create');
     Route::post('/restaurant/categories', [CategoriesRestaurantController::class, 'store'])->name('restaurant.categories.store');
     Route::delete('/restaurant/categories/{category}', [CategoriesRestaurantController::class, 'destroy'])->name('restaurant.categories.destroy');
     Route::get('/restaurant/categories/{id}/edit', [CategoriesRestaurantController::class, 'edit'])->name('restaurant.categories.edit');
     Route::put('/restaurant/categories/{category}', [CategoriesRestaurantController::class, 'update'])->name('restaurant.categories.update');
     Route::get('/restaurant/category/{category}', [CategoriesRestaurantController::class, 'produitsCategorie'])->name('restaurant.category.show');
     Route::post('/restaurant/categories/specifique/create', [CategoriesRestaurantController::class, 'createSpecifique'])->name('restaurant.categories.specifique.create');
 Route::post('/update-category-row-n', [CategoriesRestaurantController::class, 'updateCategoryRowN'])->name('restaurant.categories.update.row');

    Route::get('/restaurant/produits', [ProduitsRestoController::class, 'index'])->name('restaurant.produits.index');
    Route::get('/restaurant/produits/create', [ProduitsRestoController::class, 'create'])->name('restaurant.produits.create');
    Route::post('/restaurant/produits', [ProduitsRestoController::class, 'store'])->name('restaurant.produits.store');
    Route::get('/restaurant/produits/{id}/edit', [ProduitsRestoController::class, 'edit'])->name('restaurant.produits.edit');
    Route::put('/restaurant/produits/{produit}', [ProduitsRestoController::class, 'update'])->name('restaurant.produits.update');

    Route::post('/status/update', [ProduitsRestoController::class, 'updatestatus'])->name('restaurant.produits.update-status');
 
    Route::delete('/restaurant/produits/{produit}', [ProduitsRestoController::class, 'destroy'])->name('restaurant.produits.destroy');
   
     Route::get('/restaurant/produits/{id}', [ProduitsController::class, 'show'])->name('restaurant.produits.show');
     Route::get('produits/{produitId}/options/{optionId}', [ProduitsController::class, 'removeOption'])->name('restaurant.removeOption');
     Route::post('/restaurant/produits/get-options-by-famille-options', [ProduitsController::class, 'getOptionsByFamilleOptions'])->name('restaurant.getOptionsByFamilleOptions');
   //  Route::post('/restaurant/update-status', [ProduitsController::class, 'updateStatus'])->name('restaurant.update-status');
     Route::post('/restaurant/produits/toggle-selection', [ProduitsController::class, 'toggleSelection'])->name('restaurant.produits.toggle-selection');
    // Route::post('/restaurant/produits/add-product', [ProduitsRestoController::class, 'store'])->name('restaurant.produits.add-product');
     Route::post('/restaurant/produits/remove-product', [ProduitsController::class, 'removeProductResto'])->name('restaurant.produits.remove-product');
    Route::get('/all-products', [ProduitsRestoController::class,'getAllProducts']);
     Route::get('/restaurant/famille-options', [FamilleOptionRestoController::class, 'index'])->name('restaurant.famille-options.index');
     Route::get('/restaurant/famille-options/create', [FamilleOptionControllerResto::class, 'create'])->name('restaurant.famille-options.create');
     Route::post('/restaurant/famille-options', [FamilleOptionControllerResto::class, 'store'])->name('restaurant.famille-options.store');
     Route::get('/restaurant/famille-options/{id}/edit', [FamilleOptionControllerResto::class, 'edit'])->name('restaurant.famille-options.edit');
     Route::delete('/restaurant/famille-options/{id}', [FamilleOptionControllerResto::class, 'destroy'])->name('restaurant.famille-options.destroy');
     Route::put('/restaurant/famille-options/{id}', [FamilleOptionControllerResto::class, 'update'])->name('restaurant.famille-options.update');

     Route::get('/restaurant/options', [OptionRestoController::class, 'index'])->name('restaurant.options.index');
     Route::get('/restaurant/options/create', [OptionRestoController::class, 'create'])->name('restaurant.options.create');
     Route::post('/restaurant/options', [OptionRestoController::class, 'store'])->name('restaurant.options.store');
    
     Route::get('/restaurant/options/{option}/edit', [OptionRestoController::class, 'edit'])->name('restaurant.options.edit');
     Route::put('/restaurant/options/{option}', [OptionRestoController::class, 'update'])->name('restaurant.options.update');
    
     Route::get('/restaurant/options/remove/{option}', [OptionRestoController::class, 'remove'])->name('restaurant.options.remove');
     Route::get('restaurant/famille-options/{familleOption}', [FamilleOptionRestoController::class, 'getoptions'])->name('restaurant.famille-options.options');

     Route::get('/restaurant/paiment-methods', [PaimentRestaurantController::class, 'index'])->name('restaurant.paiment.index');
     Route::get('/restaurant/paiment-methods/create', [PaimentRestaurantController::class, 'create'])->name('restaurant.paiment.create');
     Route::post('/restaurant/paiment-methods', [PaimentRestaurantController::class, 'store'])->name('restaurant.paiment.store');
     Route::get('/restaurant/paiment-methods/{id}/edit', [PaimentRestaurantController::class, 'edit'])->name('restaurant.paiment.edit');
     Route::delete('/restaurant/paiment-methods/{id}', [PaimentRestaurantController::class, 'destroy'])->name('restaurant.paiment.destroy');
     Route::get('/restaurant/paiment-methods/{id}/edit', [PaimentRestaurantController::class, 'edit'])->name('restaurant.paiment.edit');

     Route::put('/restaurant/paiment-methods/{id}', [PaimentRestaurantController::class, 'update'])->name('restaurant.paiment.update');

    
    
     Route::get('/restaurant/livraisonmethods', [LivraisonRestaurantController::class, 'index'])->name('restaurant.livraison.index');
     Route::get('/restaurant/livraisonmethods/create', [LivraisonRestaurantController::class, 'create'])->name('restaurant.livraison.create');
     Route::post('/restaurant/livraisonmethods', [LivraisonRestaurantController::class, 'store'])->name('restaurant.livraison.store');
     Route::get('/restaurant/livraisonmethods/{id}/edit', [LivraisonRestaurantController::class, 'edit'])->name('restaurant.livraison.edit');
     Route::put('/restaurant/livraisonmethods/{id}', [LivraisonRestaurantController::class, 'update'])->name('restaurant.livraison.update');
     Route::delete('/restaurant/livraisonmethods/{LivraisonMethod}', [LivraisonRestaurantController::class, 'destroy'])->name('restaurant.livraison.destroy');
    
     Route::get('/restaurant/tables', [TablesController::class, 'index'])->name('restaurant.tables.index');
     Route::get('/restaurant/tables/create', [TablesController::class, 'create'])->name('restaurant.tables.create');
     Route::post('/restaurant/tables', [TablesController::class, 'store'])->name('restaurant.tables.store');
     Route::get('/restaurant/tables/{id}/edit', [TablesController::class, 'edit'])->name('restaurant.tables.edit');
     Route::put('/restaurant/tables/{id}', [TablesController::class, 'update'])->name('restaurant.tables.update');
     Route::delete('/restaurant/tables/{id}', [TablesController::class, 'destroy'])->name('restaurant.tables.destroy');


     Route::get('/restaurant/resevation', [ReservationTableController::class, 'index'])->name('restaurant.resevation.index');
     Route::get('/restaurant/resevation/create', [ReservationTableController::class, 'create'])->name('restaurant.resevation.create');
     Route::post('/restaurant/resevation', [ReservationTableController::class, 'store'])->name('restaurant.resevation.store');
     Route::get('/restaurant/resevation/{id}/edit', [ReservationTableController::class, 'edit'])->name('restaurant.resevation.edit');
     Route::put('/restaurant/resevation/{id}', [ReservationTableController::class, 'update'])->name('restaurant.resevation.update');
     Route::delete('/restaurant/resevation/{id}', [ReservationTableController::class, 'destroy'])->name('restaurant.resevation.destroy');
 Route::get('/restaurant/resevation/fetch', [ReservationTableController::class, 'Availabletables'])->name('restaurant.fetch.available.tables');
    Route::post('/updatereservation/status', [ReservationTableController::class, 'updateStatus'])->name('update.reservationstatus');


     Route::get('/restaurant/restaurant/edit', [RestaurantProfileController::class, 'edit'])->name('restaurant.restaurant.edit');
     Route::put('/restaurant/restaurant', [RestaurantProfileController::class, 'update'])->name('restaurant.restaurant.update');
    Route::get('/restaurant/profile/edit', [RestaurantProfileController::class, 'editprofile'])->name('restaurant.profile.edit');
     Route::put('/restaurant/profile', [RestaurantProfileController::class, 'updateprofile'])->name('restaurant.profile.update');
    
     
     Auth::routes();
    
});

 
/*Route::get('/client/login', [ClientLoginController::class, 'showLoginForm'])->name('client.login');
Route::post('/client/login', [ClientLoginController::class, 'login'])->name('client.login.submit');*/

Route::post('/client/register', [RegistrationController::class, 'register'])->name('register.submit');


Route::match(['get', 'post'], '/restaurant/logout', [AuthController::class, 'logoutResto'])->name('restaurant.logout');
Route::match(['get', 'post'], '/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');



//Route::get('/store', [ClientStoreController::class, 'store'])->name('store.index');
//Route::get('/acceuil', [AcceuilController::class, 'index'])->name('acceuil.index');
Route::get('/', function () {
    $host = request()->getHost();
    // Check if the host is 'localhost' or 'subdomain.localhost'
    if ($host === 'localhost:8000') {
        return redirect('/login');
    } else {
        // Extract the subdomain from the host
        $subdomain = explode('.', $host)[0];
        return redirect("http://$subdomain.localhost:8000/store");
    }
});

Route::get('/home', function () {
    if (auth()->check() && auth()->user()->is_admin == 1) {
            return redirect("http://" . env('mainhost') . "/admin/clients");
    } elseif (auth()->check() && auth()->user()->is_admin == 3) {
        $host = request()->getHost();
        $subdomain = explode('.', $host)[0];
        return redirect("http://$subdomain." . env('mainhost') . "/store");
    } elseif (auth()->check() && auth()->user()->is_admin == 0) {
        $host = request()->getHost();
        $userId = auth()->user()->id;
        $clientInfo = Client::where('user_id', $userId)->first();
        $pathUrl = $clientInfo->url_platform.'/restaurant/home?res';
        $subdomain = explode('.', $clientInfo->url_platform)[0];
        return redirect("http://" . env('mainhost') . "/restaurant/home?1");


      /*  if (auth()->check() && auth()->user()->is_admin == 0) {
            $userId = auth()->user()->id;
            $clientInfo = Client::where('user_id', $userId)->first();
            $pathUrl = $clientInfo->url_platform.'/restaurant/home?res';
            $subdomain = explode('.', $clientInfo->url_platform)[0];
        
            // If the subdomain is empty (for admin users), use "localhost"
            $redirectSubdomain = empty($subdomain) ? 'localhost' : $subdomain;
        
            return redirect("http://$redirectSubdomain.localhost:8000/restaurant/home?1");*/
    } else {
        session()->flush(); // Destroy the session
        abort(403, 'Unauthorized');
    }
});


   Route::get('/google',function(){

    Return view('googleAuth');
    
    });
    
    Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
    
    Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');






// facebook 

Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');

Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);







   /* Route::controller(PaymentController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::view('payment', 'paypal.index')->name('create.payment');
        Route::get('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });*/