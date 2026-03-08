<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'issued_at',
        'credential_url',
        'image',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
        ];
    }
}
