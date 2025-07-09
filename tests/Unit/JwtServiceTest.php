<?php

use App\Data\Shared\JwtPayload;
use App\Services\JwtService;

test('encodes and decodes token correctly', function () {
    $jwtService = new JwtService(
        secret: 'test-secret',
        algorithm: 'HS256',
        expirationInSec: 3600,
    );
    $fakeUserId = 5;
    $payload = new JwtPayload($fakeUserId);
    $token = $jwtService->encode($payload);
    $decoded = $jwtService->decode($token);

    expect($decoded->sub)->toBe($fakeUserId);
});

test('token contains correct expiration and issued at times', function () {
    $jwtService = new JwtService(
        secret: 'test-secret',
        algorithm: 'HS256',
        expirationInSec: 3600,
    );
    $fakeUserId = 10;
    $payload = new JwtPayload($fakeUserId);
    $now = time();
    $token = $jwtService->encode($payload);
    $decoded = $jwtService->decode($token);

    expect($decoded->iat)->toBeGreaterThanOrEqual($now)
        ->and($decoded->exp)->toBe($decoded->iat + 3600);
});

test('decoding an invalid token throws exception', function () {
    $jwtService = new JwtService(
        secret: 'test-secret',
        algorithm: 'HS256',
        expirationInSec: 3600,
    );
    $invalidToken = 'invalid.token.value';

    $this->expectException(\DomainException::class);

    $jwtService->decode($invalidToken);
});

test('token is not valid after expiration', function () {
    $jwtService = new JwtService(
        secret: 'test-secret',
        algorithm: 'HS256',
        expirationInSec: -1, // already expired
    );
    $payload = new JwtPayload(1);
    $token = $jwtService->encode($payload);

    $this->expectException(\Firebase\JWT\ExpiredException::class);

    $jwtService->decode($token);
});
