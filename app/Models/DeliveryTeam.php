<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTeam extends Model
{
    use HasFactory;

    protected $table = 'delivery_team';
    protected $primaryKey = 'team_id';
    protected $fillable = ['name', 'mobile', 'email_id'];
}
