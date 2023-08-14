<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandProduct extends Model
{
    protected $table = 'command_products';
    protected $fillable = [
        'command_id',
        'product_id',
        'quantity',
        // Add other relevant fields for command products
    ];

    public function command()
    {
        return $this->belongsTo(Command::class,'command_id');
    }

    public function product()
    {
        return $this->belongsTo(ProduitsRestaurants::class,'product_id');
    }
}
