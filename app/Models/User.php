<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserProduct;
use App\Models\Client;
use App\Models\Produits;
use App\Models\Phone;
use App\Models\PaimentMethod;
use App\Models\LivraisonMethod;






class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'restaurant_id',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
   /* public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }*/
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Produits::class, 'cart_user', 'user_id', 'product_id')
                    ->withTimestamps()
                    ->withPivot('quantity');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'user_produit');
    }
    
    public function cartItems()
    {
        return $this->hasMany(CarteUser::class, 'user_id');
    }
    public function phone()
    {
        return $this->hasOne(Phone::class, 'user_id');
    }
    public function restaurant()
    {
        return $this->belongsTo(Client::class, 'restaurant_id');
    }
    public function paimentRestaurants()
    {
        return $this->hasMany(PaimentRestaurant::class);
    }
    public function paimentMethods()
    {
        return $this->belongsToMany(PaimentMethod::class, 'paiment_restaurant', 'restaurant_id', 'paiment_id');
    }
    public function LivraisonRestaurants()
    {
        return $this->hasMany(LivraisonRestaurant::class);
    }
    public function livraisonMethods()
    {
        return $this->belongsToMany(LivraisonMethod::class, 'livraison_restaurant', 'restaurant_id', 'livraison_id');
    }
    

}
