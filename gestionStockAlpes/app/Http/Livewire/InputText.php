<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputText extends Component
{
    public $name, $label, $placeholder, $class;
    public $isOptional = false;
    public $type = 'text';

    public function render()
    {
        return view('livewire.input-text');
    }
}
