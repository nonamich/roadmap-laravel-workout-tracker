<?php

namespace App\Data\Api\Auth;

use Spatie\LaravelData\Data;

class LoginResponseData extends Data
{
    public function __construct(
        public string $token,
    ) {}
}
