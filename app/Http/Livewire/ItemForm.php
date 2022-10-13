<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Rack;

class ItemForm extends Component
{
    public $categories, $brands, $racks;

    public $itemToUpdate = null;
    
    public $category_id, $brand_id, $model, $quantity, $unit, $price, $comment, $rack_id, $rack_level;
    
    public $isFormOpen = false;

    protected $rules = [
        'category_id' => ['nullable', 'integer'],
        'brand_id' => ['nullable', 'integer'],
        'model' => ['required'],
        'quantity' => ['required', 'numeric', 'min:0'],
        'unit' => ['nullable'],
        'price' => ['required', 'numeric'],
        'comment' => ['nullable'],
        'rack_id' => ['required', 'integer'],
        'rack_level' => ['required', 'integer', 'min:1']
    ];

    protected $messages = [
        'category_id.integer' => 'l\'élément saisi est incorrect',
        'brand_id.integer' => 'l\'élément saisi est incorrect',
        'brand_id.unique' => 'Cette marque a déjà ce model dans le stock',
        'model.unique' => 'ce model existe déjà dans la stock pour cette marque',
        'model.required' => 'Le model ou la référence de l\'objet doit être rensigné.',
        'quantity.numeric' => 'la quantité doit être un nombre',
        'quantity.min' => 'la quantité doit être supérieur ou égale à 0',
        'quantity.required' => 'la quantité en stock doit être ajouté.',
        'price.required' => 'la valeur du stock doit être ajouté.',
        'price.numeric' => 'le prix doit être un nombre',
        'rack_id.integer' => 'l\'élément saisi est incorrect',
        'rack_id.required' => 'L\'emplacement de stockage dois être saisi',
        'rack_level.interger' => 'le niveau de l\'étagère dois être saisie',
        'rack_level.required' => 'L\'emplacement de stockage dois être saisi'
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
        $this->rack_id = $this->itemToUpdate?->rack_id;
        $this->rack_level = $this->itemToUpdate?->rack_level;

        $this->brands = Brand::all();
        $this->categories = Category::all();
        $this->racks = Rack::all();
    }

    public function render()
    {
        return view('livewire.item-form');
    }

    public function updated($property)
    {
        if (empty($this->itemToUpdate) || in_array($property, ['model', 'brand_id']))
        {
            $this->addDynamicRules();
        }

        $this->validateOnly($property);
        if($property == 'brand_id' && isset($this->model))
        {
            $this->validateOnly('model');
        }

        if ($property = 'rack_id' && $this->rack_level > $this->getSelectedRack()?->nb_level) {
            $this->rack_level = null;
        }
    }

    public function saveItem()
    {
        if (empty($this->itemToUpdate) || ( $this->brand_id != $this->itemToUpdate->brand_id || $this->model != $this->itemToUpdate->model) )
        {
            $this->addDynamicRules();
        }
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
        $this->isFormOpen = false;

        $this->emit('stockUpdated');
    }

    public function addDynamicRules()
    {
        array_push($this->rules['model'],'unique:items,model,NULL,id,brand_id,'.$this->brand_id);//vérifie si le model n'existe pas déjà pour la marque sélectionner
    }

    public function getSelectedRack()
    {
        return Rack::find($this->rack_id);
    }
}