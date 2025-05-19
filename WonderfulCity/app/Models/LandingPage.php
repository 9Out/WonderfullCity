<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $fillable = [
        'website_detail', 'email', 'whatsapp', 'map_link', 'carousel_images', 'visual_umkm', 'visual_wisata',
    ];

    protected $casts = [
        'carousel_images' => 'array',
    ];
}
