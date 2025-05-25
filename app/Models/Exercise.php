<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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

    public function scopeSorted(Builder $query, ?string $sortBy, ?string $sortDir)
    {
        $allowedSorts = ['created_at', 'name'];

        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        if (!in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = 'desc';
        }

        return $query->orderBy($sortBy, $sortDir);
    }

    /**
     * @return BelongsToMany<Workout, Exercise, Pivot>
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class)
            ->withPivot('sets', 'reps')
            ->withTimestamps();
    }
}
