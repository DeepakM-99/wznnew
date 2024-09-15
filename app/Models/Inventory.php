<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory_item';
    protected $primaryKey = 'item_id';
    protected $fillable = ['item_name', 'item_code', 'unit_id', 'price', 'is_active'];
}
