<?php

namespace App\Http\Livewire\Details\Rack;

use Livewire\Component;

class DetailModal extends Component
{
    public $show = false;
    public $rack;

    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.details.rack.detail-modal');
    }
}
