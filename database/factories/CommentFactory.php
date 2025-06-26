<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentable = $this->commentable();

        return [
            'body' => fake()->paragraph(),
            'commentable_id' => $commentable::factory(),
            'commentable_type' => $commentable,
            'user_id' => User::factory(),
        ];
    }

    public function commentable(): mixed
    {
        return $this->faker->randomElement([
            Schedule::class,
            Workout::class,
        ]);
    }
}
