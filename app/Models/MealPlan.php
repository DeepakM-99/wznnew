<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $table = 'meal_plan';
    protected $primaryKey = 'meal_id';
    protected $fillable = ['meal_name', 'from_date', 'to_date', 'total_amount', 'meal_calories'];
}
