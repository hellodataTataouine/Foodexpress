<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;


class Imei extends Model
{
    
    protected $table = 'tbl_imei';

    protected $fillable = [
        'Id_imei',
        'numimei',
        'N_Serie',
        'Date_Service',
        'restaurant_id',
       
    ];

    

    public function restaurant()
    {
        return $this->belongsTo(Client::class,'restaurant_id');
    }
   
}