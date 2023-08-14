<?php

namespace App\Models;
use App\Models\User;
use App\Models\PaimentRestaurant;

use Illuminate\Database\Eloquent\Model;

class PaimentMethod extends Model
{
    protected $table = 'paiement';
    protected $fillable = ['type_methode', 'created_at'];

    
    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function paimentRestaurants()
    {
        return $this->hasMany(PaimentRestaurant::class);
    }
}
