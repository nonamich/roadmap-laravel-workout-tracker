<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;

class Utils
{
    /**
     * @template TModel of \Illuminate\Database\Eloquent\Model
     *
     * @param  class-string<TModel>  $modelClass
     * @return TModel|null
     */
    public static function getModelFromRoute(string $modelClass): ?Model
    {
        $parameters = request()->route()?->parameters() ?? [];

        foreach ($parameters as $parameter) {
            if (! ($parameter instanceof $modelClass)) {
                continue;
            }

            /** @var TModel $parameter */
            return $parameter;
        }

        return null;
    }
}
