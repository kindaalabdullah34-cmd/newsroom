<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoBadWordsRule implements ValidationRule
{
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {

        $badWords = [
            'spam',
            'fake',
            'hack'
        ];

        foreach ($badWords as $word) {

            if (str_contains(
                strtolower($value),
                $word
            )) {

                $fail(
                    'Content contains forbidden words.'
                );
            }
        }
    }
}