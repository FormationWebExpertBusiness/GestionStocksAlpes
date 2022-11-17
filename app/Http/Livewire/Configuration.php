<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Configuration extends Component
{
    public $showToast = true;

    public function render()
    {
        return view('livewire.configuration')->layout('layout');
    }
}
