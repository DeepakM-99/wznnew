<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'membership_plan';
    protected $primaryKey = 'plan_id';
    protected $fillable = ['membership_plan', 'language_id', 'plan_duration', 'price', 'gender', 'per_day_meal_count', 'snack_breakfast_count', 'per_day_calory'];
}
