<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryForm extends Component
{
    public $show = false;

    public function toggleForm()
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
