<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    protected $table = 'commands';

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'statut',
        'Clientfirstname',
        'clientlastname',
         'clientPostalcode',
         'clientVille',
         'clientNum1',
         'clientNum2',
         'clientEmail',
         'methode_paiement',
         'mode_livraison',
         'prix_total',
        // Add other relevant fields for commands
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cartDetails()
    {
        return $this->hasMany(cartDetails::class,'cart_id');
    }


  /*  public function products()
    {
        return $this->hasMany(CommandProduct::class);
    }*/
   /* public function produits()
    {
        return $this->belongsToMany(ProduitsRestaurants::class, 'cart_details', 'cart_id', 'product_id')
            ->withPivot('qte_produit');
    }*/
}
