<?php

namespace App\Data\Api\Comment;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CommentUpdateRequest extends Data
{
    public function __construct(
        public Optional|string $body,
    ) {}
}
