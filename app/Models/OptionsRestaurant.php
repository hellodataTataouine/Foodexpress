<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionsRestaurant extends Model
{
    protected $table = 'options_restaurant';
    protected $fillable = [
        'nom_option',
        'prix',
        'famille_option_id_rest',
        'restaurant_id',
        
    ];

    public function familleOption()
{
    return $this->belongsTo(familleOptionsRestaurant::class, 'famille_option_id_rest');
}
public function Restaurant()
    {
        return $this->belongsTo(Client::class, 'restaurant_id');
    }
    public function produits()
    {
        return $this->belongsToMany(ProduitsRestaurants::class, 'option_produit_restaurant');
    }

}
