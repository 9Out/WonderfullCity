<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisatas';

    protected $fillable = [
        'nama_wisata',
        'slug',
        'deskripsi',
        'foto_utama',
        'list_foto',
        'alamat',
        'link_map',
    ];

    protected $casts = [
        'list_foto' => 'array',
    ];

    public $timestamps = true;
}
