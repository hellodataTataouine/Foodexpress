<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartOptionProductSelected extends Model
{
    protected $table = 'cart_option_produits_selected';
    protected $fillable = [
        'cart_id',
        'product_id',
        'option_id',
        'qte_option_selected',
        'prix_total_option',
    ];
}
