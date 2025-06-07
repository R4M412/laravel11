<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCostDetail extends Model
{
    protected $fillable = [
        'hotel_name',
        'star_rating',
        'price_50_pax',
        'price_11_12_pax',
        'price_8_10_pax',
        'price_6_7_pax',
        'price_3_5_pax',
        'price_2_pax',
        'single_sup',
    ];
}
