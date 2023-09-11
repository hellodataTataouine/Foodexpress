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
        'nbre_Personnes',
        'Heure',
        'Date',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Client::class, 'restaurant_id');
    }
    public function clientrestaurant()
    {
        return $this->belongsTo(ClientRestaurat::class, 'client_id');
    }
}
