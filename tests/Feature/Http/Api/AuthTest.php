<?php

use App\Data\Shared\JwtPayload;
use App\Models\User;
use App\Services\JwtService;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\withToken;

it('should return 401 unauthorized', function () {
    $response = getJson('/api/auth/me');

    $response->assertUnauthorized();
});

it('user can register', function () {
    $data = [
        'name' => 'Test Name',
        'email' => 'test@test.test',
        'password' => 'Password123',
    ];

    $response = postJson('/api/auth/register', $data);

    $response->assertCreated();
    assertDatabaseHas(User::class, [
        'email' => $data['email'],
    ]);
});

it('user can login', function () {
    $jwtService = app(JwtService::class);
    $password = 'Password123';
    $user = User::factory()->createOne(['password' => $password])->fresh();

    $token = postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => $password,
    ])
        ->assertOk()
        ->assertJsonStructure(['token'])
        ->json('token');
    $payload = $jwtService->decode($token);

    expect($payload->sub)->toEqual($user->id);
});

it('should return 200 for authorized', function () {
    $user = User::factory()->createOne()->fresh();
    $jwtService = app(JwtService::class);
    $token = $jwtService->encode(
        new JwtPayload($user->id)
    );

    withToken($token)->getJson('/api/auth/me')->assertOk();
});

it('user cannot login with wrong password', function () {
    $password = 'Password123';
    $user = User::factory()->createOne(['password' => $password])->fresh();

    $response = postJson('/api/auth/login', [
        'email' => $user->email,

        'password' => $password.$password,
    ]);

    $response->assertUnprocessable();
});
