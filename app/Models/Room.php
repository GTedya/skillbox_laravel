<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property ?string $description
 * @property ?string $poster_url
 * @property float $floor_area
 * @property int $price
 * @property int $hotel_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'floor_area',
        'type',
        'price',
        'hotel_id'
    ];

    protected $casts = [
      'floor_area' => 'float',
    ];
}
