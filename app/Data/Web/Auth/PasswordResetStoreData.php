<?php

namespace App\Data\Web\Auth;

use Spatie\LaravelData\Data;

class PasswordResetStoreData extends Data
{
    public function __construct(
        public string $email
    ) {}
}
