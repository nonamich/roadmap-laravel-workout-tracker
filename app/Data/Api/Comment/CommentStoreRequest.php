<?php

namespace App\Data\Api\Comment;

use Spatie\LaravelData\Data;

class CommentStoreRequest extends Data
{
    public function __construct(
        public string $body,
    ) {}
}
