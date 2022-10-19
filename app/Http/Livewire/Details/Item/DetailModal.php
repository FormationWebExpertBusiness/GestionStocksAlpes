<?php

namespace App\Http\Livewire\Details\Item;

use Livewire\Component;

class DetailModal extends Component
{
    public $show = false;
    public $item;

    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.details.item.detail-modal', [
            'show' => $this->show,
            'item' => $this->item,
        ]);
    }
}
