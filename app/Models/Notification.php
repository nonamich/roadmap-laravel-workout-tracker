<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    /**
     * @return BelongsTo<User, Notification>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'notifiable_id');
    }
}
