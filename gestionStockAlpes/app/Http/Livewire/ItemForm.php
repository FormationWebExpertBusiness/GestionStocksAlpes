<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;

class ItemForm extends Component
{

    public $itemToUpdate = null;
    
    public $category_id, $brand_id, $model, $quantity, $unit, $price;
    
    public $isFormOpen = false;

    public function mount()
    {
        $this->category_id = $this->itemToUpdate?->category_id;
        $this->brand_id = $this->itemToUpdate?->brand_id;
        $this->model = $this->itemToUpdate?->model;
        $this->quantity = $this->itemToUpdate?->quantity;
        $this->unit = $this->itemToUpdate?->unit;
        $this->price = $this->itemToUpdate?->price;    
    }

    public function render()
    {
        return view('livewire.item-form', [
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

        if (isset($this->itemToUpdate)) {
            $this->itemToUpdate->update($validatedData);
        } else {
            Item::create($validatedData);
        }

        session()->flash('message', 'Post Created Successfully.');

        $this->isFormOpen = false;

        $this->emit('stockUpdated');
    }

}