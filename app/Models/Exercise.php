<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
     * @return BelongsToMany<Workout, Exercise, Pivot>
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class)
            ->using(ExerciseWorkout::class)
            ->withPivot('sets', 'reps')
            ->withTimestamps();
    }
}
