<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';

    protected $fillable = [
        
        'nbre_Personnes',
        'designation',
        'photo',
        'id_restaurant',
        
    ];

    public function restaurant()
    {
        return $this->belongsTo(Client::class, 'id_restaurant');
    }
    public function reservation()
    {
         return $this->hasMany(Table::class, 'table_id');
    }
   
}
