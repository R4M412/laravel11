<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kota_destinasi_id',
        'display_price', // Harga manual untuk card
        'deskripsi',
        'gambar',
        'overview',
        'destinations',
        'itinerary', // <-- TAMBAHKAN BARIS INI
        'land_tour_prices',
        'hotel_pricings',
        'foreign_guest_surcharges',
        'facilities_include',
        'facilities_exclude',
        'remarks',
    ];

    protected $casts = [
        'destinations' => 'array',
        'itinerary' => 'array', // <-- TAMBAHKAN BARIS INI
        'land_tour_prices' => 'array',
        'hotel_pricings' => 'array',
        'foreign_guest_surcharges' => 'array',
        'facilities_include' => 'array',
        'facilities_exclude' => 'array',
    ];

    public function kotaDestinasi(): BelongsTo
    {
        return $this->belongsTo(KotaDestinasi::class);
    }
}