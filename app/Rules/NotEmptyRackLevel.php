<?php

namespace App\Rules;

use App\Models\Rack;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class NotEmptyRackLevel implements DataAwareRule, InvokableRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

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
        $rack = Rack::find($this->data['rack']['id']);
        if ($rack->$attribute > $value) {
            for ($i = $value + 1; $i <= $rack->$attribute; $i++) {
                if ($rack->itemsOnLevel($i)->count()) {
                    $fail('Il reste des Items sur '.$rack->name.' étage '.$i);
                }
            }
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
