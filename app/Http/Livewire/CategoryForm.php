<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryForm extends Component
{
    public $showDropdown = false;

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
