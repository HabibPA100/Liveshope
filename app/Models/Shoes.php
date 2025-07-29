<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoes extends Model
{
    protected $fillable = [
        'title',
        'price',
        'rating',
        'image',
    ];
}

