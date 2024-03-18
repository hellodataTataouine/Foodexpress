<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    protected $table = 'reservation_table';

    protected $fillable = [
        'restaurant_id',
        'client_id',
        'table_id',
        'nbre_Personnes',
        'heure_debut',
        'heure_fin',
        'date',
        'statut',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Client::class, 'restaurant_id');
    }
    public function tables()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
    public function clientrestaurant()
    {
        return $this->belongsTo(ClientRestaurat::class, 'client_id');
    }
}
