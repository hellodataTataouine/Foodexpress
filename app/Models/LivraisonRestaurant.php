<?php

namespace App\Models;
use App\Models\User;
use App\Models\LivraisonMethod;

use Illuminate\Database\Eloquent\Model;

class LivraisonRestaurant extends Model
{
    protected $table = 'livraison_restaurant';

    protected $fillable = [
        'restaurant_id',
        'livraison_id',
    ];
    public function livraison()
    {
        return $this->belongsTo(Livraison::class, 'livraison_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function livraisonMethod()
    {
        return $this->belongsTo(LivraisonMethod::class);
    }
}
