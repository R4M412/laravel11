<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class HotelPricing extends Model {
    use HasFactory;
    protected $fillable = [ 'wisata_id', 'hotel_name', 'single_supplement' ];
    public function wisata(): BelongsTo { return $this->belongsTo(Wisata::class); }
    public function priceTiers(): HasMany { return $this->hasMany(PriceTier::class); }
}