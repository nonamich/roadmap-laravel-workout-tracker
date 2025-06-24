<?php

namespace App\Data\Web;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserShareWebData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {}
}
