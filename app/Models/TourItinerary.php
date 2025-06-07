<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourItinerary extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'location'];

    /**
     * Mendefinisikan bahwa satu TourItinerary memiliki banyak item.
     * Nama fungsi 'items' ini akan kita gunakan di Repeater.
     */
    public function items(): HasMany
    {
        return $this->hasMany(TourItineraryItem::class)->orderBy('sort_order');
    }
}
