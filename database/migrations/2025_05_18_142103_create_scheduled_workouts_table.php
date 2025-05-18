<?php

use App\Enums\ScheduledWorkoutStatus;
use App\Models\RecurringSchedule;
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
        Schema::create('scheduled_workouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('scheduled_at');
            $table->string('status');
            $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(RecurringSchedule::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_workouts');
    }
};
