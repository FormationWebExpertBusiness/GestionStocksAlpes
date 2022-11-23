<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Menu extends Component
{
    public $isConfigurationTabOpen;
    public $route;

    public function mount()
    {
        $this->route = Route::current()->uri;
    }

    public function render()
    {
        return view('livewire.menu');
    }
}
