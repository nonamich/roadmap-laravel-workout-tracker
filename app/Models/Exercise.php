<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property ExerciseWorkout $pivot
 */
class Exercise extends Model
{
    /** @use HasFactory<\Database\Factories\ExerciseFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'category',
        'description',
        'user_id',
    ];

    /**
     * @return BelongsToMany<Workout, $this, ExerciseWorkout>
     */
    public function workouts(): BelongsToMany
    {
        return $this->belongsToMany(Workout::class)
            ->withPivot('sets', 'reps')
            ->using(ExerciseWorkout::class)
            ->withTimestamps();
    }
}
