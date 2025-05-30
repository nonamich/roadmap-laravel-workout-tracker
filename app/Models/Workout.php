<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Workout extends Model
{
    /** @use HasFactory<\Database\Factories\WorkoutFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * @return MorphMany<Comment, Workout>
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return BelongsToMany<Exercise, Workout, Pivot>
     */
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class)
            ->withPivot('sets', 'reps')
            ->withTimestamps();
    }

    /**
     * @return HasMany<Recurrence, Workout>
     */
    public function recurrences(): HasMany
    {
        return $this->hasMany(Recurrence::class);
    }

    /**
     * @return HasMany<Schedule, Workout>
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
