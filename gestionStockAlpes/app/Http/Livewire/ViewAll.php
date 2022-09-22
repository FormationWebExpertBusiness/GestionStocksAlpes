<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ViewAll extends Component
{
    public $items;

    public function render()
    {
        return view('livewire.view-all', [
            'items' => $this->items
        ]);
    }
}
 