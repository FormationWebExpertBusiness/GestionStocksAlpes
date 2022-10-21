<?php

namespace App\Http\Livewire\Forms\Category;

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
        return view('livewire.forms.category.category-form');
    }
}
