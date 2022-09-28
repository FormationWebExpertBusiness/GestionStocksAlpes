<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Filtres extends Component
{
    public $isVisible = false;

    public function toggleDropdown()
    {
        $this->isVisible = !$this->isVisible;
    }

    public function render()
    {
        return view('livewire.filtres');
    }
}
