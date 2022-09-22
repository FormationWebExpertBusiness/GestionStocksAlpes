<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailModal extends Component
{
    public $isVisible = 0;

    public function render()
    {
        return view('livewire.detail-modal', [
            'isVisible' => $this->isVisible
        ]);
    }
}
