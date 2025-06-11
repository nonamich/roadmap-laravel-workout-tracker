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

    protected function weekdays(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value || $value === '0' ? array_map('intval', explode(',', $value)) : [],
            set: fn ($value) => is_array($value) ? implode(',', $value) : $value,
        );
    }

    /**
     * @return BelongsTo<Workout, Recurrence>
     */
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * @return HasMany<Schedule, Recurrence>
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
