<?php

use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Workout;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

it('should create a schedule', function () {
    $user = User::factory()->createOne();
    $workout = Workout::factory()->for($user)->createOne();

    actingAs($user, 'api')
        ->postJson('/api/schedules', [
            'scheduled_at' => now()->addDay()->toAtomString(),
            'workout_id' => $workout->id,
        ])
        ->assertCreated();

    assertDatabaseCount(Schedule::class, 1);
});

it('returns unprocessable for wrong date', function () {
    $user = User::factory()->createOne();
    $workout = Workout::factory()->for($user)->createOne();

    actingAs($user, 'api')
        ->postJson('/api/schedules', [
            'scheduled_at' => now()->sub('day', 1)->toAtomString(),
            'workout_id' => $workout->id,
        ])
        ->assertUnprocessable();

    assertDatabaseCount(Schedule::class, 0);
});

it('returns unprocessable with wrong workout_id', function () {
    $actor = User::factory()->createOne();
    $owner = User::factory()->createOne();
    $workout = Workout::factory()->for($owner)->createOne();

    actingAs($actor, 'api')
        ->postJson('/api/schedules', [
            'scheduled_at' => now()->addDay()->toAtomString(),
            'workout_id' => $workout->id,
        ])
        ->assertUnprocessable();

    assertDatabaseCount(Schedule::class, 0);
});

it('forbids access to a schedule for non-owner', function () {
    $actor = User::factory()->createOne();
    $owner = User::factory()->createOne();
    $schedule = Schedule::factory()->for($owner)->createOne();

    actingAs($actor, 'api')
        ->getJson("/api/schedules/$schedule->id")
        ->assertForbidden();
});

it('forbids updating to a schedule for non-owner', function () {
    $actor = User::factory()->createOne();
    $owner = User::factory()->createOne();
    $schedule = Schedule::factory()->for($owner)->createOne();

    actingAs($actor, 'api')
        ->putJson("/api/schedules/$schedule->id", [
            'scheduled_at' => now()->addDay()->toAtomString(),
        ])
        ->assertForbidden();
});

it('returns unprocessable when updating scheduled_at is in the past', function () {
    $actor = User::factory()->createOne();
    $schedule = Schedule::factory()->for($actor)->createOne();

    actingAs($actor, 'api')
        ->putJson("/api/schedules/$schedule->id", [
            'scheduled_at' => now()->subDay()->toAtomString(),
        ])
        ->assertUnprocessable();
});

it('returns unprocessable when updating status to done before scheduled_at', function () {
    $actor = User::factory()->createOne();
    $schedule = Schedule::factory()->for($actor)->createOne([
        'scheduled_at' => now()->addDay()->toAtomString(),
    ]);

    actingAs($actor, 'api')
        ->putJson("/api/schedules/$schedule->id", [
            'status' => ScheduleStatus::Done,
        ])
        ->assertUnprocessable();
});

it('returns ok when updating status to done after scheduled_at', function () {
    $actor = User::factory()->createOne();
    $schedule = Schedule::factory()->for($actor)->createOne([
        'scheduled_at' => now()->subHour()->toAtomString(),
    ]);

    actingAs($actor, 'api')
        ->putJson("/api/schedules/$schedule->id", [
            'status' => ScheduleStatus::Done,
        ])
        ->assertOk();
});

it('returns ok when updating status to missed after scheduled_at', function () {
    $actor = User::factory()->createOne();
    $schedule = Schedule::factory()->for($actor)->createOne([
        'scheduled_at' => now()->subHour()->toAtomString(),
    ]);

    actingAs($actor, 'api')
        ->putJson("/api/schedules/$schedule->id", [
            'status' => ScheduleStatus::Missed,
        ])
        ->assertOk();
});
