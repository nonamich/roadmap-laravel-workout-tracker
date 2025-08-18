<?php

namespace App\Models;

use App\Enums\ScheduleStatus;
use App\Exceptions\InvalidStatusChangeException;
use App\Observers\ScheduleObserver;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon $scheduled_at
 * @property ScheduleStatus $status
 * @property int $user_id
 * @property int $workout_id
 * @property int|null $recurrence_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Recurrence|null $recurrence
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Workout $workout
 *
 * @method static \Database\Factories\ScheduleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereRecurrenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Schedule whereWorkoutId($value)
 *
 * @mixin \Eloquent
 */
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

    /**
     * @param  Builder<$this>  $query
     * @return Builder<$this>
     */
    public function scopeOutdated(Builder $query): Builder
    {
        return $query->where('scheduled_at', '<', now())
            ->where('status', ScheduleStatus::Scheduled);
    }

    /**
     * @param  Builder<$this>  $query
     * @return Builder<$this>
     */
    public function scopeOverdue(Builder $query): Builder
    {
        return $query
            ->where('scheduled_at', '<', now()->subDay())
            ->whereIn('status', [ScheduleStatus::WaitForAction, ScheduleStatus::Scheduled]);
    }
}
