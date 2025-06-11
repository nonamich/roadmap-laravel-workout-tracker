<?php

namespace App\Rules;

use Spatie\LaravelData\Attributes\Validation\Regex;

class TimeRule extends Regex
{
    public function __construct()
    {
        parent::__construct('/^(?:[01]\d|2[0-3]):[0-5]\d(?::[0-5]\d)?$/');
    }
}
