<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    use HasFactory;

    protected $table = 'delivery_location';
    protected $primaryKey = 'location_id';
    protected $fillable = ['location_name', 'delivery_zone', 'delivery_amount', 'status'];
}
