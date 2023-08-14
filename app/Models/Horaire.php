<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{
    protected $fillable = ['client_id', 'date_debut', 'date_fin', 'heure_ouverture', 'heure_fermeture'];
}
