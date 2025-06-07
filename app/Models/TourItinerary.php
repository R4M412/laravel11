<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
     protected $fillable = ['day_number', 'day_title', 'location'];

    public function items()
    {
         return $this->hasMany(\App\Models\TourItineraryItem::class);
    }
}
