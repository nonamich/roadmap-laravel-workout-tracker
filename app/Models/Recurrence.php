<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $weekdays
 * @property string $time
 * @property int $user_id
 * @property int $workout_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Schedule> $schedules
 * @property-read int|null $schedules_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Workout $workout
 * @method static \Database\Factories\RecurrenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereWeekdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recurrence whereWorkoutId($value)
 * @mixin \Eloquent
 */
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
        'user_id',
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

    /**
     * @return BelongsTo<User, covariant $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(related: User::class);
    }
}
