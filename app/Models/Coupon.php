<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';
    protected $primaryKey = 'coupon_id';
    protected $fillable = ['coupon_title', 'description', 'discount', 'expiry_date', 'discount_type', 'percent_discount', 'rupee_discount'];
}
