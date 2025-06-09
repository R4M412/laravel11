<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PriceTier extends Model {
    use HasFactory;
    protected $fillable = [ 'hotel_pricing_id', 'min_pax', 'max_pax', 'price' ];
    public function hotelPricing(): BelongsTo { return $this->belongsTo(HotelPricing::class); }
}