<?php

namespace App\Http\Livewire;

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
        return view('livewire.detail-modal', [
            'show' => $this->show,
            'item' => $this->item,
        ]);
    }
}
