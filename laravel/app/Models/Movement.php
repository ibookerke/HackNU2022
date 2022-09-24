<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $latitude
 * @property $longitude
 * @property float $altitude
 * @property Carbon|string|null $timestamp
 * @property int $x_value
 * @property int $y_value
 * @property string $identifier
 * @property string $floor_label
 * @property float $h_accuracy
 * @property float $v_accuracy
 * @property float $accuracy_confidence
 * @property string $activity
 */

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'altitude',
        'timestamp',
        'identifier',
        'floor_label',
        'h_accuracy',
        'v_accuracy',
        'accuracy_confidence',
        'activity',
        'x_value',
        'y_value'
    ];

    protected $casts = [
        'latitude' => 'decimal',
        'longitude' => 'decimal',
        'altitude' => 'float',
        'timestamp' => 'timestamp',
        'identifier' => 'string',
        'floor_label' => 'string',
        'h_accuracy' => 'float',
        'v_accuracy' => 'float',
        'accuracy_confidence' => 'double',
        'activity' => 'string',
        'x_value' => 'int',
        'y_value' => 'int'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
