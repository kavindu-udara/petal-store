<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProfileImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'seller_id',
    ];
}
