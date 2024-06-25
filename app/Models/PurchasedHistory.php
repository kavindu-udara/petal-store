<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'qty',
        'status',
        'product_id',
        'user_id',
    ];
}
