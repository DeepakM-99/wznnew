<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;

    protected $table = 'allergy';
    protected $primaryKey = 'allergy_id';
    protected $fillable = ['allergy_name'];
}
