<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupDelivery extends Model
{
    use HasFactory;

    protected $table = 'delivery_status';
    protected $primaryKey = 'delivery_id';
    protected $fillable = ['status'];
}
