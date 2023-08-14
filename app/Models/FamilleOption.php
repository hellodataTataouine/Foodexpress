<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;
use App\Models\Produits;


class FamilleOption extends Model
{

    protected $fillable = [
        'nom_famille_option',
        'type',
    ];
    protected $table = 'famille_options';
    

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produits_famille_option', 'famille_option_id', 'produit_id');
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    
}
