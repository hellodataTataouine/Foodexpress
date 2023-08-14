<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FamilleOption;
use App\Models\Produits;
use App\Models\User;


class Option extends Model
{
    protected $table = 'options';
    

    public function familleOption()
{
    return $this->belongsTo(FamilleOption::class, 'famille_option_id');
}

public function produits()
{
    return $this->belongsToMany(Produits::class, 'produit_option', 'option_id', 'produit_id');
}
public function users()
{
    return $this->hasMany(User::class);
}

}
