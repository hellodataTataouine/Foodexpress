<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class familleOptionsRestaurant extends Model
{

    protected $fillable = [
        'nom_famille_option',
        'type',
    ];

    protected $table = 'famille_options_restaurant';
    

    public function produits()
    {
        return $this->belongsToMany(ProduitsRestaurants::class, 'produit_familleoptions_restaurant', 'id_produit_rest', 'id_familleoptions_rest');
    }

    public function options()
    {
        return $this->hasMany(OptionsRestaurant::class);
    }
}
