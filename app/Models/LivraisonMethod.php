<?php

namespace App\Models;
use App\Models\User;
use App\Models\LivraisonRestaurant;

use Illuminate\Database\Eloquent\Model;

class LivraisonMethod extends Model
{
    protected $table = 'livraisons';
    protected $fillable = ['methode'];

    
    
    public function livraisonRestaurant()
    {
        return $this->hasMany(LivraisonRestaurant::class);
    }
}
