<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfileImage extends Model
{
    use HasFactory;
    // Specify the table name
    protected $table = 'user_profile_images';
    protected $fillable = [
        'name',
        'user_id',
    ];

}
