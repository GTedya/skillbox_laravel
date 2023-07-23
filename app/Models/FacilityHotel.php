<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $hotel_id
 * @property int $facility_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class FacilityHotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'hotel_id',
    ];

    public function facilableHotels(): MorphTo
    {
        return $this->morphTo();
    }
}
