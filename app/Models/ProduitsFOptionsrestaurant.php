<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitsFOptionsrestaurant extends Model
{
    protected $table = 'produit_familleoptions_restaurant';
    
    protected $fillable = [
        'id_produit_rest',
        'id_familleoptions_rest',
    ];

    public function produitRestaurant()
    {
        return $this->belongsTo(ProduitsRestaurants::class, 'id_produit_rest');
    }

    public function familleOption()
    {
        return $this->belongsTo(familleOptionsRestaurant::class, 'id_familleoptions_rest');
    }
}
