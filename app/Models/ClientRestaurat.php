<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class ClientRestaurat extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'clientrestaurant';

    protected $fillable = [
        'FirstName',
        'LastName',
        'ville',
        'Address',
        'codepostal', 
        'phoneNum1',
        'phoneNum2',
        'email',
        'password',
        'restaurant_id',
        
    ];
      /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guard = 'clientRestaurant';
}
