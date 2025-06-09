<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'kota_destinasi_id', 'judul', 'slug', 'gambar', 'deskripsi', 'overview',
        'destinations', 'itinerary', 'facilities_include', 'facilities_exclude',
        'remarks', 'price_without_hotel', 'foreign_prices',
    ];

    protected $casts = [
        'destinations' => 'array',
        'itinerary' => 'array',
        'facilities_include' => 'array',
        'facilities_exclude' => 'array',
        'foreign_prices' => 'array',
    ];

    public function kotaDestinasi(): BelongsTo
    {
        return $this->belongsTo(KotaDestinasi::class);
    }

    public function hotelPricings(): HasMany
    {
        return $this->hasMany(HotelPricing::class);
    }
    
    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => $model->slug = Str::slug($model->judul));
        static::updating(fn ($model) => $model->isDirty('judul') ? $model->slug = Str::slug($model->judul) : false);
    }
}