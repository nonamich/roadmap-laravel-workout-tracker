<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $workout_id
 * @property int $exercise_id
 * @property int $sets
 * @property int $reps
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereExerciseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereReps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereSets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExerciseWorkout whereWorkoutId($value)
 * @mixin \Eloquent
 */
class ExerciseWorkout extends Pivot
{
    protected $fillable = ['reps', 'sets', 'order'];

    protected $attributes = [
        'order' => 0,
    ];
}
