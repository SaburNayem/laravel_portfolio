<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'description',
        'technologies',
        'github_url',
        'live_url',
        'is_featured',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'is_featured' => 'boolean',
        ];
    }
}
