<?php
// dalam file app/Models/HotelCostDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelCostDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'single_sup',
    ];

    public function priceRules(): HasMany
    {
        return $this->hasMany(PriceRule::class);
    }

    public function getPriceForPax(int $paxCount): ?float
    {
        $rule = $this->priceRules()
            ->where('min_pax', '<=', $paxCount)
            ->where('max_pax', '>=', $paxCount)
            ->first();

        return $rule ? (float) $rule->price : null;
    }
}