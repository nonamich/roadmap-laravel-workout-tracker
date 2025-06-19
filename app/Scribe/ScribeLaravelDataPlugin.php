<?php

namespace App\Scribe;

use Illuminate\Routing\Route;
use Knuckles\Camel\Extraction\ExtractedEndpointData;
use Knuckles\Scribe\Extracting\ParsesValidationRules;
use Knuckles\Scribe\Extracting\Strategies\Strategy;
use ReflectionClass;
use ReflectionException;
use ReflectionFunctionAbstract;
use ReflectionUnionType;
use Spatie\LaravelData\Data;

final class ScribeLaravelDataPlugin extends Strategy
{
    use ParsesValidationRules;

    public function __invoke(ExtractedEndpointData $endpointData, array $settings = []): ?array
    {
        return $this->getParametersFromLaravelDataRequest($endpointData->method, $endpointData->route);
    }

    public function getParametersFromLaravelDataRequest(ReflectionFunctionAbstract $method, Route $route): array
    {
        if (! $formRequestReflectionClass = $this->getRequestReflectionClass($method)) {
            return [];
        }

        /** @var class-string<Data> $className */
        $className = $formRequestReflectionClass->getName();

        $parametersFromFormRequest = $this->getParametersFromValidationRules(
            $className::getValidationRules([])
        );

        return $this->normaliseArrayAndObjectParameters($parametersFromFormRequest);
    }

    public function getRequestReflectionClass(ReflectionFunctionAbstract $method): ?ReflectionClass
    {
        foreach ($method->getParameters() as $argument) {
            $argType = $argument->getType();
            if ($argType === null || $argType instanceof ReflectionUnionType) {
                continue;
            }

            $argumentClassName = $argType->getName();

            if (! class_exists($argumentClassName)) {
                continue;
            }

            try {
                $argumentClass = new ReflectionClass($argumentClassName);
            } catch (ReflectionException $e) {
                continue;
            }

            if (class_exists(Data::class) && $argumentClass->isSubclassOf(Data::class)) {
                return $argumentClass;
            }
        }

        return null;
    }
}
