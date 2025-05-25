<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WeekdaysRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail("The {$attribute} must be an array.");

            return;
        }

        foreach ($value as $item) {
            if (!is_int($item) || $item < 1 || $item > 7) {
                $fail("Each value in {$attribute} must be an integer between 1 and 7.");

                return;
            }
        }

        if (count($value) !== count(array_unique($value))) {
            $fail("The {$attribute} must contain unique values.");

            return;
        }

        $sorted = $value;

        sort($sorted);
        if ($value !== $sorted) {
            $fail("The {$attribute} must be sorted in ascending order.");

            return;
        }
    }
}
