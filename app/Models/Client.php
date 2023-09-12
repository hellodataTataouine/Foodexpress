<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserProduct;
use App\Models\Horaire;
use App\Models\User;
use App\Models\CarteUser;
use App\Models\ClientPostalCode;



class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'phoneNum1',
        'phoneNum2',
        'localisation',
        'url_platform',
        'logo',
        'date',
        'status',
        'N_Siret',
        'N_Tva',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userProduct()
    {
        return $this->hasMany(UserProduct::class, 'user_id');
    }
    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }
    public function postalCodes()
    {
        return $this->hasMany(ClientPostalCode::class);
    }
    public function jourFeriers ()
    {
        return $this->hasMany(JourFerier::class);
    }
    public function commands()
    {
        return $this->hasMany(Command::class);
    }

    public function devices()
    {
        return $this->hasMany(Imei::class, 'restaurant_id');
    }



}
