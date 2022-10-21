<?php

namespace App\Http\Livewire\Details\Item;

use Livewire\Component;

class DetailModalContent extends Component
{
    public $commonItem;

    public function render()
    {
        return view('livewire.details.item.detail-modal-content');
    }
}
