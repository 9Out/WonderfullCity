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
        'rentang_harga',
        'nomor_telepon',
        'user_id',
    ];

    protected $casts = [
        'list_foto' => 'array',
        'rentang_harga' => 'array',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
