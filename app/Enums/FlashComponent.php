<?php

namespace App\Enums;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum FlashComponent: string
{
    case ExerciseCreated = 'exercise-created';
    case ExerciseUpdated = 'exercise-updated';
    case WorkoutUpdated = 'workout-updated';
}
