<?php

use App\Enums\RecurringScheduleWeekday;
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
        Schema::create('recurring_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->unsignedTinyInteger('weekday')->unsigned();
            $table->time('time');
            $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
            $table->unique(['name', 'workout_id']);
            $table->unique(['workout_id', 'weekday', 'time']);
        });

         DB::statement("
            ALTER TABLE recurring_schedules
            ADD CONSTRAINT check_weekday
            CHECK (weekday >= 0 AND weekday <= 6)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_schedules');
    }
};
