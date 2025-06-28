<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;

class InvalidStatusChangeException extends AuthorizationException
{
    public function __construct()
    {
        parent::__construct('Invalid Status Change');
    }
}
