<?php

use App\Models\Workout;
use App\Rules\ExistsForUserRule;

it('passes', function () {
    $workout = Workout::factory()->createOne();

    $this->actingAs($workout->user);

    $validator = Validator::make([
        'workout' => $workout->id,
    ], [
        'workout' => new ExistsForUserRule(Workout::class),
    ]);

    expect($validator->passes())->toBeTrue();
});

it('fails if workout does not belong to user', function () {
    $workout = Workout::factory()->createOne();
    $otherUser = \App\Models\User::factory()->createOne();

    $this->actingAs($otherUser);

    $validator = Validator::make([
        'workout' => $workout->id,
    ], [
        'workout' => new ExistsForUserRule('workouts'),
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('workout'))->toContain('does not belong to you');
});

it('fails if workout does not exist', function () {
    $user = \App\Models\User::factory()->createOne();
    $this->actingAs($user);

    $validator = Validator::make([
        'workout' => 999999,
    ], [
        'workout' => new ExistsForUserRule(Workout::class),
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('workout'))->toContain('invalid');
});
