<?php

namespace App\Data\Shared;

use App\Models\User;
use Spatie\LaravelData\Data;

class JwtPayload extends Data
{
    public function __construct(
        public int $userId,
    ) {}

    public static function fromModel(User $user): JwtPayload
    {
        return new self(
            userId: $user->id,
        );
    }
}
