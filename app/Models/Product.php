<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'category_path' => 'array',
        'tags' => 'array',
        'colors' => 'array',
        'sizes' => 'array',
        'is_featured' => 'boolean',
        'published_at' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
