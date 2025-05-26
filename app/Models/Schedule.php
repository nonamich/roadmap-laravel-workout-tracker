<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

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
    ];

    /**
     * @return BelongsTo<Workout, Schedule>
     */
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * @return BelongsTo<Recurrence, Schedule>
     */
    public function recurrence()
    {
        return $this->belongsTo(Workout::class);
    }
}
