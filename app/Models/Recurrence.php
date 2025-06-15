<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recurrence extends Model
{
    /** @use HasFactory<\Database\Factories\RecurrenceFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'weekdays',
        'time',
        'workout_id',
    ];

    /**
     * Summary of weekdays
     */
    /**
     * @return Attribute<int[], string>
     */
    protected function weekdays(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ((is_string($value) && ($value || $value === '0'))) {
                    return array_map('intval', explode(',', $value));
                }

                return [];
            },
            set: function ($value) {
                if (is_array($value)) {
                    return implode(',', $value);
                }

                return $value;
            },
        );
    }

    /**
     * @return BelongsTo<Workout, covariant $this>
     */
    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * @return HasMany<Schedule, covariant $this>
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
