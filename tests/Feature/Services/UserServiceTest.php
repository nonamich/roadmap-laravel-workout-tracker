<?php

use App\Data\Shared\CreateUserAction;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

it('should be instance', function () {
    $userService = app(UserService::class);

    expect($userService)->toBeInstanceOf(UserService::class);
});

it('should user add correctly', function () {
    Event::fake();
    $data = [
        'name' => 'test name',
        'email' => 'test@test.test',
        'password' => 'password1234',
    ];
    $userService = app(UserService::class);
    $user = $userService->create(
        CreateUserAction::from($data)
    );

    expect($user)->toBeInstanceOf(User::class);

    Event::assertDispatched(Registered::class);

    $this->assertDatabaseHas('users', [
        'email' => $data['email'],
    ]);
    $this->assertNotEquals($data['password'], $user->password);
    $this->assertTrue(Hash::check($data['password'], $user->password));
});
