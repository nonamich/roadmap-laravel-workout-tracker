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
use Spatie\LaravelData\Support\DataContainer;

abstract class BaseGetFromLaravelData extends Strategy
{
    /**
     * @var string[]
     */
    public array $availableMethods = [];

    use ParsesValidationRules;

    public function __invoke(ExtractedEndpointData $endpointData, array $settings = []): ?array
    {
        if (! array_intersect($this->availableMethods, $endpointData->route->methods)) {
            return [];
        }

        return $this->getParametersFromLaravelDataRequest($endpointData->method, $endpointData->route);
    }

    public function getParametersFromLaravelDataRequest(ReflectionFunctionAbstract $method, Route $route): array
    {
        if (! $formRequestReflectionClass = $this->getRequestReflectionClass($method)) {
            return [];
        }

        /** @var class-string<Data> $className */
        $className = $formRequestReflectionClass->getName();
        $reflection = new ReflectionClass($className);
        $dataConfig = DataContainer::get()->dataClassFactory()->build($reflection);
        $payload = [];

        foreach ($dataConfig->properties as $property) {
            if (! $property->defaultValue) {
                continue;
            }

            $payload[$property->inputMappedName ?? $property->name] = $property->defaultValue;
        }

        $parametersFromFormRequest = $this->getParametersFromValidationRules(
            $className::getValidationRules($payload)
        );

        foreach ($dataConfig->properties as $property) {
            if (! $property->defaultValue) {
                continue;
            }

            $param = &$parametersFromFormRequest[$property->inputMappedName ?? $property->name];

            if ($param['required'] === true) {
                $param['required'] = false;
            }
        }

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
