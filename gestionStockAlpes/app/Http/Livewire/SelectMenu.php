<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectMenu extends Component
{

    public $name, $label, $listOption;
    public $isOptional = false;

    public function render()
    {
        return view('livewire.select-menu');
    }
}
