<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkms';

    protected $fillable = [
        'nama_umkm',
        'slug',
        'deskripsi',
        'foto_utama',
        'list_foto',
    ];

    protected $casts = [
        'list_foto' => 'array',
    ];

    public $timestamps = true;
}
