<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'icon',
        'images',
        'order',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean'
    ];
}
