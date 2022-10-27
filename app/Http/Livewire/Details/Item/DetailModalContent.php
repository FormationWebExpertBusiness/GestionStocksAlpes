<?php

namespace App\Http\Livewire\Details\Item;

use Livewire\Component;

class DetailModalContent extends Component
{
    public $commonItem;

    public $warningDeleteItemSignal = 'deleteItem';

    public function render()
    {
        return view('livewire.details.item.detail-modal-content');
    }
    public function openWarningDelete($itemId)
    {
        $this->emit('deleteWarning', $itemId, $this->warningDeleteItemSignal, 'Item', 'serial_number');
    }
}
