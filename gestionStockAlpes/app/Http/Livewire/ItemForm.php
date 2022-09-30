<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;

class ItemForm extends Component
{

    public $itemToUpdate = null;
    
    public $category_id, $brand_id, $model, $quantity, $unit, $price, $comment;
    
    public $isFormOpen = false;

    protected $rules = [
        'category_id' => ['nullable', 'integer'],
        'brand_id' => ['nullable', 'integer'],
        'model' => ['required', 'alpha_dash'],
        'quantity' => ['required', 'numeric'],
        'unit' => ['nullable'],
        'price' => ['required', 'numeric'],
        'comment' => ['nullable']
    ];

    protected $messages = [
        'category_id.integer' => 'l\'élément saisie est incorrecte',
        'brand_id.integer' => 'l\'élément saisie est incorrecte',
        'model.required' => 'Le model ou la référence de l\'objet doit être rensigné.',
        'model.required' => 'Des caractères spéciaux nom autorisé sont utilisés.',
        'quantity.numeric' => 'la quantité doit être un nombre',
        'quantity.required' => 'la quantité en stock doit être ajouté.',
        'price.required' => 'la quantité en stock doit être ajouté.',
        'price.numeric' => 'le prix doit être un nombre'
    ];

    public function mount()
    {
        $this->category_id = $this->itemToUpdate?->category_id ?? 1;
        $this->brand_id = $this->itemToUpdate?->brand_id ?? 1;
        $this->model = $this->itemToUpdate?->model;
        $this->quantity = $this->itemToUpdate?->quantity;
        $this->unit = $this->itemToUpdate?->unit;
        $this->price = $this->itemToUpdate?->price;
        $this->comment = $this->itemToUpdate?->comment;
    }

    public function render()
    {
        return view('livewire.item-form', [
            'brands' => Brand::all(),
            'categories' => Category::all()
        ]);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function saveItem()
    {
        $validatedData = $this->validate();

        if (isset($this->itemToUpdate)) {
            $this->itemToUpdate->update($validatedData);
        } else {
            Item::create($validatedData);
        }

        $this->closeForm();
    }

    public function closeForm()
    {
        $this->category_id = $this->itemToUpdate?->category_id ?? 1;
        $this->brand_id = $this->itemToUpdate?->brand_id ?? 1;
        $this->model = $this->itemToUpdate?->model;
        $this->quantity = $this->itemToUpdate?->quantity;
        $this->unit = $this->itemToUpdate?->unit;
        $this->price = $this->itemToUpdate?->price;
        $this->comment = $this->itemToUpdate?->comment;

        $this->isFormOpen = false;

        $this->emit('stockUpdated');
    }

}