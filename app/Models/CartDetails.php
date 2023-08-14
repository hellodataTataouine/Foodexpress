<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produits;
use App\Models\CartOptionProduitsSelected;

class CartDetails extends Model
{
    protected $table = 'cart_details';
    protected $fillable = [
        'cart_id',
        'product_id',
        'qte_produit',
        'optionsdetails',
        'cart_option_product_selected_id',
    ];

    public function produit()
    {
        return $this->belongsTo(ProduitsRestaurants::class, 'product_id');
    }

    public function cartOptionProduitsSelected()
    {
        return $this->hasMany(CartOptionProduitsSelected::class, 'id_cart');
    }}
