<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    /**
     * @return MorphTo<Model, covariant $this>
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
