<?php

namespace App\Models;
use App\Models\User;
use App\Models\PaimentMethod;

use Illuminate\Database\Eloquent\Model;

class PaimentRestaurant extends Model
{
    protected $table = 'paiment_restaurant';

    protected $fillable = [
        'restaurant_id',
        'paiment_id',
        'client_id' ,
        'client_secret',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paimentMethod()
    {
        return $this->belongsTo(PaimentMethod::class);
    }
}
