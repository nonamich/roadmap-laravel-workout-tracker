<?php

namespace App\Data\Api\Auth;

use App\Models\User;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;

class LoginStoreApiData extends Data
{
    public function __construct(
        #[Email, Exists(User::class, 'email')]
        public string $email,

        #[Password(default: true)]
        public string $password,
    ) {}
}
