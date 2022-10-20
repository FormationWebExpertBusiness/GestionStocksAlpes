<?php

namespace App\Http\Livewire\Forms\Rack;

use Livewire\Component;

class RackForms extends Component
{
    public $showDropdown = false;

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function render()
    {
        return view('livewire.forms.rack.rack-forms');
    }
}
