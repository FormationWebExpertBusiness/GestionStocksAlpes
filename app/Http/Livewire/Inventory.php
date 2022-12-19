<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Inventory extends Component
{
    public function render()
    {
        return view('livewire.inventory')->layout('layout');
    }
}
