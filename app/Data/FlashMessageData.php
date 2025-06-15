<?php

namespace App\Data;

use App\Enums\FlashComponent;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FlashMessageData extends Data
{
    public function __construct(
        public mixed $props = null,
        public ?FlashComponent $component = null,
        public ?string $title = null,
    ) {}
}
