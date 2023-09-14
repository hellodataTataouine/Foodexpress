<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use Illuminate\Notifications\Notifiable;

class Imei extends Model
{
    use Notifiable;
    
    protected $table = 'tbl_imei';

    protected $fillable = [
        'Id_imei',
        'numimei',
        'N_Serie',
        'Date_Service',
        'restaurant_id',
        'fcm_token'
       
    ];

    public function restaurant()
    {
        return $this->belongsTo(Client::class,'restaurant_id');
    }


   
}