<?php

namespace App\Data\Api\Auth;

use App\Models\User;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class RegisterStoreApiData extends Data
{
    public function __construct(
        #[Max(255)]
        public string $name,

        #[Email, Unique(User::class, 'email')]
        public string $email,

        #[Password(default: true)]
        public string $password,
    ) {}
}
