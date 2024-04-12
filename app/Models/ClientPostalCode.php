<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;


class ClientPostalCode extends Model
{
    protected $table = 'client_postal_codes';

    protected $fillable = [
        'client_id',
        'postal_code',
        'min_cmd',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
