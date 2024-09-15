<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'menu_id', 'order_status'];
    protected $table = "orders";
    protected $primaryKey = 'order_id';

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function foodmenu()
    {
        return $this->belongsTo(FoodMenu::class, 'menu_id');
    }
}
