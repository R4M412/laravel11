<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandTourOnlyCost extends Model
{
    protected $fillable = [
        'participant_range', // e.g., "3–5 Pax"
        'price_per_person',  // e.g., 1250
    ];
}
