<?php

namespace App\Models;

use App\Enums\ScheduleStatus;
use App\Exceptions\InvalidStatusChangeException;
use App\Observers\ScheduleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([ScheduleObserver::class])]
class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    // If you're using Laravel 8 or above, you can use the $casts property:
    protected $casts = [
        'scheduled_at' => 'datetime',
        'status' => ScheduleStatus::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'scheduled_at',
        'status',
        'recurrence_id',
        'workout_id',
        'user_id',
    ];

    /**
     * @return BelongsTo<Workout, Schedule>
     */
    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * @return BelongsTo<Recurrence, Schedule>
     */
    public function recurrence(): BelongsTo
    {
        return $this->belongsTo(Recurrence::class);
    }

    /**
     * @return BelongsTo<User, Schedule>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsDone()
    {
        if (now()->lt($this->scheduled_at)) {
            throw new InvalidStatusChangeException;
        }

        $this->status = ScheduleStatus::Done;

        $this->save();
    }

    public function markAsMissed()
    {
        if (now()->lt($this->scheduled_at)) {
            throw new InvalidStatusChangeException;
        }

        $this->status = ScheduleStatus::Missed;

        $this->save();
    }
}
