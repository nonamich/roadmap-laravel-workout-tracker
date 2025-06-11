<?php

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
        Schema::create('recurrences', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->set('weekdays', range(0, 6));
            $table->time('time');
            $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
            $table->unique(['name', 'workout_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurrences');
    }
};
