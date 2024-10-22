<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'og_image',
        'logo_v1',
        'logo_v2',
        'email',
        'phone',
        'address',
        'social_links'
    ];

    // Cast social links as an array
    protected $casts = [
        'social_links' => 'array',
    ];
}
