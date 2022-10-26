<?php

namespace App\Http\Livewire\Forms\Brand;

use Livewire\Component;

class BrandForm extends Component
{ 
    public $showDropdown = false;

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }
    public function render()
    {
        return view('livewire.forms.brand.brand-form');
    }
}
