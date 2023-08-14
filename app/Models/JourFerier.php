<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourFerier extends Model
{
    protected $table = 'jour_ferier';

    protected $fillable = [
        'client_id',
        'jour',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
