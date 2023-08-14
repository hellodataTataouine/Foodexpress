<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesRestaurant extends Model
{
    protected $fillable = ['name','restaurantid','date_creation'];
    protected $dates = ['date_creation'];
    public $timestamps = true;
    protected $table = 'categories_restaurant';
    protected $primaryKey = 'id';

   
    public function produits_restaurant()
    {
        return $this->hasMany(ProduitsRestaurants::class, 'categorie_rest_id');
    }
   /* public function users()
    {
        return $this->hasMany(User::class);
    }*/

}
