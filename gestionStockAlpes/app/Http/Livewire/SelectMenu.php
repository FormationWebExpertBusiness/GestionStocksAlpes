<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectMenu extends Component
{

    public $name, $listOption, $inputValue;

    public $label = "";
    public $isOptional = false;

    public function render()
    {
        return view('livewire.select-menu');
    }
}
