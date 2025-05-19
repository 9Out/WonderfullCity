<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkms'; // default Laravel pakai plural
    public $timestamps = false;

    protected $fillable = [
        'nama_umkm',
        'deskripsi',
        'foto_utama',
        'list_foto',
    ];

    // Custom accessor untuk array list_foto
    public function getListFotoArrayAttribute()
    {
        return explode(',', $this->list_foto);
    }
}
