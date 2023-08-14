<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRestaurat extends Model
{
    protected $table = 'clientrestaurant';

    protected $fillable = [
        'FirstName',
        'LastName',
        'ville',
        'Address',
        'postalcode', 
        'phoneNum1',
        'phoneNum2',
        'Email',
        'password',
        
    ];
    
}
