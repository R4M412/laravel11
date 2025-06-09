<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PulauDestinasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'judul',
        'slug', // <-- Pastikan slug ada di sini
        'deskripsi',
    ];

    // Pastikan relasi ini ada untuk menampilkan "Jumlah Kota"
    public function kotaDestinasis(): HasMany
    {
        return $this->hasMany(KotaDestinasi::class);
    }

    // Pastikan fungsi boot ini ada untuk slug otomatis
    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => $model->slug = Str::slug($model->judul));
        static::updating(fn ($model) => $model->isDirty('judul') ? $model->slug = Str::slug($model->judul) : false);
    }
}