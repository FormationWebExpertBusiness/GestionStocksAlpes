<?php

namespace App\Http\Livewire\Details\Item;

use Livewire\Component;

class DetailModal extends Component
{
    public $show = false;
    public $commonItem;

    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.details.item.detail-modal', [
            'show' => $this->show,
            'commonItem' => $this->commonItem,
        ]);
    }
}
