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
            'scheduled_at' => now(),
            'status' => ScheduleStatus::Scheduled,
            'workout_id' => Workout::factory(),
            'user_id' => User::factory(),
            'recurrence_id' => null,
        ];
    }

    public function withRecurrence(): static
    {
        return $this->state(fn (array $attributes) => [
            'recurrence_id' => Recurrence::factory(),
        ]);
    }
}
