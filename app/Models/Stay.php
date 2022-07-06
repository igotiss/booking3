<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'amenities',
        'rooms',
        'beds',
        'type',
        'location',
        'price',
        'user_id',
    ];
}
