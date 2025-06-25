<?php

namespace Database\Factories;

use App\Enums\ScheduleStatus;
use App\Models\Recurrence;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scheduled_at' => fake()->dateTime(),
            'status' => ScheduleStatus::Scheduled,
            'workout_id' => Workout::factory(),
            'user_id' => User::factory(),
            'recurrence_id' => Recurrence::factory(),
        ];
    }
}
