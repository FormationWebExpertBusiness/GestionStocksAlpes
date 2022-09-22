<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;

class ItemForm extends Component
{

    public $item;

    public function render()
    {
        return view('livewire.item-form', [
            'item' => $this->item,
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    private function resetInputFields(){
        $this->item = new Item();
    }
}