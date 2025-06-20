<?php

namespace App\Scribe;

class BodyGetFromLaravelData extends BaseGetFromLaravelData
{
    /**
     * @var string[]
     */
    public array $availableMethods = ['POST', 'PUT', 'PATCH'];
}
