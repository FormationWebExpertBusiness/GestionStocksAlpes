<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;

class ItemForm extends Component
{

    public $category_id, $brand_id, $model, $quantity, $unit, $price;

    public $isCreatingNewItem = false;

    public function render()
    {
        return view('livewire.item-form', [
            'item' => $this->item ?? new Item(),
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    public function saveItem()
    {
        $validatedData = $this->validate([
            'category_id' => 'nullable',
            'brand_id' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'unit' => 'nullable',
            'price' => 'required'
        ]);

        Item::create($validatedData);

        session()->flash('message', 'Post Created Successfully.');

        $this->isCreatingNewItem = false;

        return redirect('/stock');
    }

}