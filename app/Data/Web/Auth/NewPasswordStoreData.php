<?php

namespace App\Data\Web\Auth;

use App\Models\User;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Confirmed;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class NewPasswordStoreData extends Data
{
    public function __construct(
        public string $token,

        #[Email, Exists(User::class, 'email')]
        public string $email,

        #[Password(default: true), Confirmed]
        public string $password,

        public string $passwordConfirmation,
    ) {}
}
