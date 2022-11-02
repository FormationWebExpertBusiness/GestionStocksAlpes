<?php

namespace App\Http\Livewire\Details\Item;

use Livewire\Component;

class DetailModal extends Component
{
    public $show = false;
    public $commonItem;
    public $rack;
    public $rack_level;

    public $warningDeleteItemSignal = 'deleteItem';

    protected $listeners = [
        'racksFilter' => 'getRack',
        'rackLevelsFilter' => 'getRackLevel',
    ];

    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.details.item.detail-modal');
    }

    public function openWarningDelete($itemId)
    {
        $this->emit('deleteWarning', $itemId, $this->warningDeleteItemSignal, 'Item', 'serial_number');
    }

    public function getRack($rack)
    {
        $this->rack = $rack;
    }

    public function getRackLevel($rackLevel)
    {
        $this->rack_level = $rackLevel;
    }
}
