<?php

namespace App\Http\Livewire;
use App\Models\Item;

use Livewire\Component;

class DeleteItem extends Component
{
    public $itemId;

    public function deleteItem()
    {
        $item = Item::findOrFail($this->itemId);
        $item->delete();
        
    }

    public function render()
    {
        return view('livewire.delete-item');
    }
}
