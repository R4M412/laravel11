<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $fillable =[
        'gambar_thumbnail',
        'gambar_wisata',
        'judul',
        'deskripsi',
        'harga_paket',
        'transportasi',
        'itenary',
        'fasilitas',
        'remarks',
        'additional',
    ];

    protected $casts = [
        'gambar_wisata' => 'array', // karena json di database
        'harga_paket' => 'float',
    ];
}
