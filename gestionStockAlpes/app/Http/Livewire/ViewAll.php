<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewAll extends Component
{
    public $items;

    public $isCreatingNewItem = false;

    public function render()
    {
        return view('livewire.view-all', [
            'items' => $this->items
        ]);
    }

    public function openForm(){
        return $this->isCreatingNewItem = true;
    }
}
 