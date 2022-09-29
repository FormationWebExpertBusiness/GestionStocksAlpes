<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailModalContent extends Component
{
    public $item;

    public function render()
    {
        return view('livewire.detail-modal-content', [
            'item' => $this->item
        ]);
    }
}
