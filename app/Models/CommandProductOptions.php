<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandProductOptions extends Model
{
    protected $table = 'commandproductoptions';
    protected $fillable = [
        'commandProduit_id',
        'options_id',
        'qte_options',
        // Add other relevant fields for command products
    ];

    public function commandProduit()
    {
        return $this->belongsTo(CommandProduct::class);
    }

    public function options()
    {
        return $this->belongsTo(OptionsRestaurant::class);
    }
}
