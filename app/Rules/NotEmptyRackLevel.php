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
        $rack = Rack::find($this->data['selectedRack']);
        if ($rack->nb_level > $this->data['nb_level']) {
            for ($i = $this->data['nb_level'] + 1; $i <= $rack->nb_level; $i++) {
                if ($rack->ItemsOnLevel($i)->count()) {
                    $fail('Il reste des Items sur l\''.$rack->name.' étage '.$i);
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
