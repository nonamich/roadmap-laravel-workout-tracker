<?php

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

        Schema::create('exercise_workout', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Exercise::class)->constrained()->cascadeOnDelete();
            $table->tinyInteger('sets')->unsigned();
            $table->tinyInteger('reps')->unsigned();
            $table->tinyInteger('order')->unsigned();
        });

        DB::statement('
            ALTER TABLE exercise_workout
            ADD CONSTRAINT check_sets_and_reps
            CHECK (reps > 0 AND sets > 0)
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_workout');
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('workouts');
    }
};
