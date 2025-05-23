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
        'alamat',
        'link_map',
        'rentang_harga',
        'nomor_telepon',
    ];

    protected $casts = [
        'list_foto' => 'array',
        'rentang_harga' => 'array',
    ];

    public $timestamps = true;
}

