<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Configuration extends Component
{
    public $showToast = true;

    public $tabs = ['Catégorie', 'Marque', 'Étagère'];
    public $tab;

    public function changeTab($i)
    {
        $this->tab = $this->tabs[$i];
    }

    public function mount()
    {
        $this->tab = $this->tabs[1];
    }
    public function render()
    {
        return view('livewire.configuration')->layout('layout');
    }
}
