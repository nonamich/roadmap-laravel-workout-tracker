<?php

use App\Rules\WeekdaysRule;

test('fails when weekdays is not an array', function () {
    $validator = Validator::make([
        'weekdays' => 'not-an-array',
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('fails when weekdays contains non-integer values', function () {
    $validator = Validator::make([
        'weekdays' => [0, 1, '2', 3],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('fails when weekdays contains duplicate values', function () {
    $validator = Validator::make([
        'weekdays' => [0, 1, 1, 2, 3],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('passes for single valid weekday', function () {
    $validator = Validator::make([
        'weekdays' => [3],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->passes())->toBeTrue();
});

test('passes for empty array', function () {
    $validator = Validator::make([
        'weekdays' => [],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->passes())->toBeTrue();
});

test('fails when weekdays contains null', function () {
    $validator = Validator::make([
        'weekdays' => [0, null, 2],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('fails when weekdays contains float values', function () {
    $validator = Validator::make([
        'weekdays' => [0, 1.5, 2],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});
test('fails when weekdays are not in ascending order', function () {
    $validator = Validator::make([
        'weekdays' => [2, 1, 3],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('fails when weekdays are in descending order', function () {
    $validator = Validator::make([
        'weekdays' => [6, 5, 4, 3, 2, 1, 0],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('fails when weekdays are partially sorted', function () {
    $validator = Validator::make([
        'weekdays' => [0, 2, 1, 3],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->fails())->toBeTrue();
});

test('passes when weekdays are in correct ascending order', function () {
    $validator = Validator::make([
        'weekdays' => [0, 1, 2, 3, 4, 5, 6],
    ], [
        'weekdays' => new WeekdaysRule,
    ]);

    expect($validator->passes())->toBeTrue();
});
