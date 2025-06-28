<?php

namespace App\Models;

use App\Enums\ScheduleStatus;
use App\Exceptions\InvalidStatusChangeException;
use App\Observers\ScheduleObserver;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy([ScheduleObserver::class])]
class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

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

    protected $attributes = [
        'status' => ScheduleStatus::Scheduled,
    ];

    /**
     * @return BelongsTo<Workout, covariant $this>
     */
    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * @return BelongsTo<Recurrence, covariant $this>
     */
    public function recurrence(): BelongsTo
    {
        return $this->belongsTo(Recurrence::class);
    }

    /**
     * @return BelongsTo<User, covariant $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function canUpdateWithRecurrence(): bool
    {
        if ($this->recurrence_id) {
            return ! in_array($this->getDirtyForUpdate(), ['scheduled_at']);
        }

        return true;
    }

    public function canDeleteWithRecurrence(): bool
    {
        return ! $this->recurrence_id;
    }

    public function setStatusAttribute(ScheduleStatus $newStatus): void
    {
        if (
            $newStatus === $this->status ||
            (
                in_array($newStatus, [ScheduleStatus::WaitForAction, ScheduleStatus::Done, ScheduleStatus::Missed]) &&
                in_array($this->status, [ScheduleStatus::Scheduled, ScheduleStatus::WaitForAction]) &&
                now()->gt($this->scheduled_at)
            )
        ) {
            $this->attributes['status'] = $newStatus;

            return;
        }

        throw new InvalidStatusChangeException;
    }

    protected static function booted()
    {
        static::deleting(function (self $model) {
            if (! $model->canDeleteWithRecurrence()) {
                throw new AuthorizationException;
            }
        });

        static::updating(function (self $model) {
            if (! $model->canUpdateWithRecurrence()) {
                throw new AuthorizationException;
            }
        });
    }

    /**
     * @return MorphMany<Comment, covariant $this>
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
