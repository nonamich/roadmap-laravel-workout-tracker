<?php

namespace App\Data;

use App\Enums\FlashComponent;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FlashMessageData extends Data
{
    /**
     * @param string|array|null $props
     */
    public function __construct(
        public mixed $props,
        public ?FlashComponent $component,
        public ?string $title,
    ) {
    }
}
