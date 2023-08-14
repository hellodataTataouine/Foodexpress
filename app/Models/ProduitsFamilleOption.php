<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produits;
use App\Models\FamilleOptions;
use App\Models\User;

class ProduitsFamilleOption extends Model
{
    protected $table = 'produits_famille_option';
    
    protected $fillable = [
        'produit_id',
        'famille_option_id',
    ];

    public function produit()
    {
        return $this->belongsTo(Produits::class, 'produit_id');
    }

    public function familleOption()
    {
        return $this->belongsTo(FamilleOptions::class, 'famille_option_id');
    }
   /* public function users()
    {
        return $this->hasMany(User::class);
    }*/
}
