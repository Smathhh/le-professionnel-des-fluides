<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'before_image',
        'after_image',
        'category',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
