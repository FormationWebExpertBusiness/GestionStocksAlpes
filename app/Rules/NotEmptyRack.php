<?php

namespace App\Rules;

use App\Models\Rack;
use Illuminate\Contracts\Validation\InvokableRule;

class NotEmptyRack implements InvokableRule
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
        $rack = Rack::find($value);
        if ($rack->itemsOn()->count()) {
            $fail('L\'étagère ne peut pas être supprimée car elle contient des produits');
        }
    }
}
