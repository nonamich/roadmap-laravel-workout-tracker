<?php

use App\Rules\TimeRule;
use Illuminate\Support\Facades\Validator;

test('time rule accepts valid time with seconds', function () {
    $validator = Validator::make([
        'time' => '23:59:59',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->passes())->toBeTrue();
});

test('time rule accepts midnight', function () {
    $validator = Validator::make([
        'time' => '00:00',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->passes())->toBeTrue();
});

test('time rule rejects invalid hour', function () {
    $validator = Validator::make([
        'time' => '24:00',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('time rule rejects invalid minute', function () {
    $validator = Validator::make([
        'time' => '12:60',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('time rule rejects invalid seconds', function () {
    $validator = Validator::make([
        'time' => '12:30:60',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('time rule rejects missing leading zero', function () {
    $validator = Validator::make([
        'time' => '9:05',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('time rule rejects non-numeric', function () {
    $validator = Validator::make([
        'time' => 'ab:cd',
    ], [
        'time' => new TimeRule,
    ]);

    expect($validator->fails())->toBeTrue();
});
