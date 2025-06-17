<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Container\Attributes\Config;
use Illuminate\Contracts\Auth\Authenticatable;

class JwtService
{
    public function __construct(
        #[Config('jwt.secret')]
        private string $secret,

        #[Config('jwt.algorithm')]
        private string $algorithm,

        #[Config('jwt.expiration_in_sec')]
        private int $expirationInSec,
    ) {}

    public function encode(Authenticatable $user): string
    {
        return JWT::encode(
            $this->createPayload($user),
            $this->secret,
            $this->algorithm,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function createPayload(Authenticatable $user): array
    {
        $timestamp = time();

        return [
            'sub' => $user->getAuthIdentifier(),
            'iat' => $timestamp,
            'exp' => $timestamp + $this->expirationInSec,
        ];
    }

    public function decode(string $token): \stdClass
    {
        $payload = JWT::decode(
            $token,
            new Key($this->secret, $this->algorithm),
        );

        return $payload;
    }
}
