<?php

use App\Data\Shared\JwtPayload;
use App\Services\JwtService;

beforeEach(function () {
    $this->jwtService = new JwtService(
        secret: 'test-secret',
        algorithm: 'HS256',
        expirationInSec: 3600,
    );
});

it('encodes and decodes token correctly', function () {
    $fakeUserId = 5;
    $payload = new JwtPayload($fakeUserId);
    $token = $this->jwtService->encode($payload);
    $decoded = $this->jwtService->decode($token);

    expect($decoded->sub)->toBe($fakeUserId);
});
