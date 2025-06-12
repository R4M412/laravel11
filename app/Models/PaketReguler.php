<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketReguler extends Model
{
    use HasFactory;

    /**
     * Mass assignment protection.
     * `guarded` dengan array kosong artinya semua field boleh diisi.
     */
    protected $guarded = [];

    /**
     * Mendefinisikan relasi bahwa setiap pesanan PASTI milik satu paket wisata.
     */
    public function wisata(): BelongsTo
    {
        return $this->belongsTo(Wisata::class);
    }
}