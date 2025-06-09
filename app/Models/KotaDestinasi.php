<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class KotaDestinasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pulau_destinasi_id',
        'gambar',
        'judul',
        'slug',
        'deskripsi',
    ];

    /**
     * Relasi "ke atas": Memberitahu bahwa satu Kota MILIK satu Pulau.
     */
    public function pulauDestinasi(): BelongsTo
    {
        return $this->belongsTo(PulauDestinasi::class);
    }

    /**
     * Relasi "ke bawah": Persiapan untuk nanti, satu Kota PUNYA BANYAK Paket Wisata.
     * Ganti 'Wisata' dengan nama model paket wisatamu nanti.
     */
    public function wisatas(): HasMany
    {
        return $this->hasMany(Wisata::class);
    }
    
    /**
     * Logika Otomatisasi untuk membuat slug dari judul
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => $model->slug = Str::slug($model->judul));
        static::updating(fn ($model) => $model->isDirty('judul') ? $model->slug = Str::slug($model->judul) : false);
    }
}