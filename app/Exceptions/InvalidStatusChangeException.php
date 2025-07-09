<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class InvalidStatusChangeException extends UnprocessableEntityHttpException
{
    public function __construct()
    {
        parent::__construct('Invalid Status Change');
    }
}
