<?php

use App\Rules\UniqueForUserRule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    Schema::create('test_items', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('user_id');
    });

    $this->user1 = \App\Models\User::factory()->createOne();
    $this->user2 = \App\Models\User::factory()->createOne();
});

it('passes when value is unique for user', function () {
    $this->actingAs($this->user1);

    DB::table('test_items')->insert([
        'name' => 'Item 1',
        'user_id' => $this->user1->id,
    ]);

    $rule = new UniqueForUserRule('test_items', 'name');
    $result = validator(['name' => 'Item 2'], ['name' => [$rule]])->passes();

    expect($result)->toBeTrue();
});

it('fails when value is not unique for user', function () {
    $this->actingAs($this->user1);

    DB::table('test_items')->insert([
        'name' => 'Item 1',
        'user_id' => $this->user1->id,
    ]);

    $rule = new UniqueForUserRule('test_items', 'name');
    $result = validator(['name' => 'Item 1'], ['name' => [$rule]])->passes();

    expect($result)->toBeFalse();
});

it('passes when value is not unique for another user', function () {
    DB::table('test_items')->insert([
        'name' => 'Item 1',
        'user_id' => $this->user2->id,
    ]);

    $this->actingAs($this->user1);

    $rule = new UniqueForUserRule('test_items', 'name');
    $result = validator(['name' => 'Item 1'], ['name' => [$rule]])->passes();

    expect($result)->toBeTrue();
});

it('passes when ignoring current record', function () {
    $this->actingAs($this->user1);

    $id = DB::table('test_items')->insertGetId([
        'name' => 'Item 1',
        'user_id' => $this->user1->id,
    ]);

    $rule = new UniqueForUserRule('test_items', 'name', 'user_id', $id);
    $result = validator(['name' => 'Item 1'], ['name' => [$rule]])->passes();

    expect($result)->toBeTrue();
});
