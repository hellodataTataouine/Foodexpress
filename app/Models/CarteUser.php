<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProduitsRestaurants;
use App\Models\User;
use App\Models\Client;
use App\Models\CartDetail;

class CarteUser extends Model
{

    protected $table = 'cart_user';
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'prix_total',
        'methode_paiement',
        'mode_livraison',
        'statut_paiement',
    ];
    
    public function product()
    {
        return $this->belongsTo(ProduitsRestaurants::class, 'product_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class, 'cart_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Client::class, 'restaurant_id');
    }

    }
