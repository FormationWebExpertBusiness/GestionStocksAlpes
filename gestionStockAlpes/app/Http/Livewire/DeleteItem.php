<?php

namespace App\Http\Livewire;
use App\Models\Item;

use Livewire\Component;

class DeleteItem extends Component
{
    public $itemId;
    public $champ;
    public $mode;

    public function render()
    {
        return view('livewire.delete-item', [
            'champ' => $this->champ,
            'mode' => $this->mode
        ]);
    }
}
