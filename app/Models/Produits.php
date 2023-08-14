<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\UserProduct;
use App\Models\User;
use App\Models\Option;
use App\Models\FamilleOption;


class Produits extends Model
{
    protected $fillable = [
        'nom_produit',
        'description',
        'url_image',
        'prix',
        'categorie_id',
        'status',
        'owner_id',
    ];

    protected $table = 'produits';

    public function categories()
    {
        return $this->belongsTo(categories::class, 'categorie_id');
    }
   
    public function familleOptions()
    {
        return $this->belongsToMany(FamilleOption::class, 'produits_famille_option', 'produit_id', 'famille_option_id');
    }
    

  /*  public function options()
{
    return $this->belongsToMany(Option::class, 'produits_famille_option', 'produit_id', 'famille_option_id');
}*/

 /* public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }
*/
  /*  public function users()
    {
        return $this->belongsToMany(User::class, 'user_product', 'product_id', 'user_id');
    }

*/

}
