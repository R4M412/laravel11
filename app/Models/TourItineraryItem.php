<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Tambahkan ini

class TourItineraryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_itinerary_id',
        'day',
        'sort_order',
        'title',
        'type',
        'description',
        'options'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(TourItinerary::class, 'tour_itinerary_id');
    }
}