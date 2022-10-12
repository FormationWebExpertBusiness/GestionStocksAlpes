<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryEditForm extends Component
{
    public $show = false;

    public function toggleEditForm()
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.category-edit-form');
    }
}
