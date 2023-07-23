<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property ?string $description
 * @property ?string $poster_url
 * @property string $address
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'address'
    ];

    public function facilities(): MorphMany
    {
        return $this->morphMany(Facility::class, 'facilableHotels', 'facility_hotels');
    }
}
