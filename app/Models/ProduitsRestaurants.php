<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitsRestaurants extends Model
{
    protected $fillable = [
        'nom_produit',
        'description',
        'url_image',
        'prix',
        'categorie_rest_id',
        'status',
        
    ];

    protected $table = 'produits_restaurant';

    public function categories()
    {
        return $this->belongsTo(CategoriesRestaurant::class, 'categorie_rest_id');
    }
   
    public function familleOptions()
    {
        return $this->belongsToMany(familleOptionsRestaurant::class, 'produit_familleoptions_restaurant', 'id_produit_rest', 'id_familleoptions_rest');
    }
    public function commands()
    {
        return $this->belongsToMany(Command::class, 'command_products')
                    ->withPivot('quantity');
    }
   /* public function options()
    {
        return $this->belongsToMany(OptionsRestaurant::class, 'cart_option_produits_selected', 'product_id', 'option_id','cart_id')
            ->withPivot('qte_option_selected', 'prix_total_option');
    }*/
    public function options()
{
    return $this->belongsToMany(OptionsRestaurant::class, 'cart_option_produits_selected','product_id', 'option_id')
        ->withPivot('qte_option_selected', 'prix_total_option');
}
}
