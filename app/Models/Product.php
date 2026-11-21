<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'image',
        'price',
        'category',
        'is_active',
        'order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];
}
