<?php

namespace App\Data\Shared;

use Spatie\LaravelData\Data;

class CreateUserAction extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}
