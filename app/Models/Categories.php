<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produits;
use App\Models\User;


class Categories extends Model
{
    protected $fillable = ['name', 'date_creation'];
    protected $dates = ['date_creation'];
    public $timestamps = true;
    protected $table = 'categories';
    protected $primaryKey = 'id';

   
    public function produits()
    {
        return $this->hasMany(Produits::class, 'categorie_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

}

