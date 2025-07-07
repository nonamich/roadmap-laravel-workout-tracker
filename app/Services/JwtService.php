<?php

namespace App\Services;

use App\Data\Shared\JwtPayload;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Container\Attributes\Config;

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

    public function encode(JwtPayload $payload): string
    {
        return JWT::encode(
            $this->serializePayload($payload),
            $this->secret,
            $this->algorithm,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function serializePayload(JwtPayload $payload): array
    {
        $timestamp = time();

        return [
            'sub' => $payload->userId,
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
