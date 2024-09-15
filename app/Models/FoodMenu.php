<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_id', 'menu', 'sweet_salad', 'allergy_id', 'item_id', 'kcal_per_gram', 'cooking_instruction'];
    protected $table = "food_menu";
    protected $primaryKey = 'menu_id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
