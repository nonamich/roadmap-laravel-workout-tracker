<?php

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('repetitions')->unsigned()->check('repetitions >= 1');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->unique(['title', 'user_id']);
        });

        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('category');
            $table->text('description')->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->unique(['name', 'user_id']);
        });

        Schema::create('workout_exercise', function (Blueprint $table) {
            $table->timestamps();

            $table->foreignId('workout_id')->constrained()->cascadeOnDelete();
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('repetitions')->unsigned()->check('repetitions >= 1');

            $table->primary(['workout_id', 'exercise_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('workouts');
    }
};
