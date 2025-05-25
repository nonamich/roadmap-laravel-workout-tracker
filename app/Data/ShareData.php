<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ShareData extends Data
{
    public function __construct(
        public ?UserShareData $user,
        public FlashMessageData|string|null $flash,
    ) {
    }
}
