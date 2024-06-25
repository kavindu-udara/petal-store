<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'line',
        'postal_code',
        'user_id',
        'city_id',
    ];
}
