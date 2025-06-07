<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourItineraryItem extends Model
{
   protected $fillable = ['tour_itinerary_id', 'type', 'content', 'options'];

    protected $casts = [
        'options' => 'array',
    ];

   public function tourItinerary()
{
    return $this->belongsTo(\App\Models\TourItinerary::class);
}

}