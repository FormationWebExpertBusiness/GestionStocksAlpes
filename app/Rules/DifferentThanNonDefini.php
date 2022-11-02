<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class DifferentThanNonDefini implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     *
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ($value === 'Non défini' || $value === null || $value === '1') {
            $fail('L\'attribut doit être défini.');
        }
    }
}
