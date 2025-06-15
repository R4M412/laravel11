<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wisata extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'kota_destinasi_id',
        'display_price',
        'duration_text',
        'duration_days',
        'deskripsi',
        'gambar',
        'overview',
        'destinations',
        'itinerary',
        'land_tour_prices',
        'hotel_pricings',
        'foreign_guest_surcharges',
        // 'facilities_include', // DIHAPUS
        // 'facilities_exclude', // DIHAPUS
        'remarks',
        'facilities_include_text', // DITAMBAH
        'facilities_exclude_text', // DITAMBAH
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'destinations' => 'array',
        'itinerary' => 'array',
        'land_tour_prices' => 'array',
        'hotel_pricings' => 'array',
        'foreign_guest_surcharges' => 'array',
        // 'facilities_include' => 'array', // DIHAPUS
        // 'facilities_exclude' => 'array', // DIHAPUS
    ];

    /**
     * Mendapatkan kota destinasi dari paket wisata.
     */
    public function kotaDestinasi(): BelongsTo
    {
        return $this->belongsTo(KotaDestinasi::class);
    }

    /**
     * Mendapatkan semua pesanan paket reguler untuk paket wisata ini.
     * Relasi ini WAJIB ADA agar Resource Filament bisa bekerja.
     */
    public function paketRegulers(): HasMany
    {
        return $this->hasMany(PaketReguler::class);
    }
}