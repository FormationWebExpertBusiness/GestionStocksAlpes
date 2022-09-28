<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;

class ItemForm extends Component
{

    public $category, $brand, $model, $quantity, $unit, $price;

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
            'category' => '',
            'brand' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'unit' => '',
            'price' => 'required'
        ]);

        Item::create($validatedData);
        // dd($this);
        
        // $item = new Item();
        // $item->category_id = $this->category ?? $item->category_id;
        // $item->brand_id = $this->brand ?? $item->brand_id;
        // $item->model = $this->model ?? $item->model;
        // $item->quantity = $this->quantity ?? $item->quantity;
        // $item->unit = $this->unit ?? $item->unit;
        // $item->price = $this->price ?? $item->price; 
        // $item->save();

        session()->flash('message', 'Post Created Successfully.');

        $this->isCreatingNewItem = false;

        return redirect('/stock');
    }

}