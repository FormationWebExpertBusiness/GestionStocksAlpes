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
        'model' => ['required'],
        'quantity' => ['required', 'numeric', 'min:0'],
        'unit' => ['nullable'],
        'price' => ['required', 'numeric'],
        'comment' => ['nullable']
    ];

    protected $messages = [
        'category_id.integer' => 'l\'élément saisie est incorrecte',
        'brand_id.integer' => 'l\'élément saisie est incorrecte',
        'brand_id.unique' => 'Cette marque a déjà ce model dans le stock',
        'model.unique' => 'ce model existe déjà dans la stock pour cette marque',
        'model.required' => 'Le model ou la référence de l\'objet doit être rensigné.',
        'quantity.numeric' => 'la quantité doit être un nombre',
        'quantity.min' => 'la quantité doit être supérieur ou égale à 0',
        'quantity.required' => 'la quantité en stock doit être ajouté.',
        'price.required' => 'la valeur du stock doit être ajouté.',
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
        if (empty($this->itemToUpdate) || in_array($property, ['model', 'brand_id']))
        {
            $this->addDynamicRules();
        }
        $this->validateOnly($property);
        if($property == 'brand_id' && isset($this->model))
        {
            $this->validateOnly('model');
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
            $item = Item::create($validatedData);
        }

        $this->closeForm();
        if(isset($this->itemToUpdate)){
            return redirect('stock')->with('status', 'L\'objet '.$this->model.' a bien été modifié !');
        }else{
            return redirect('stock')->with('status', 'L\'objet '.$item->model.' a bien été créé !');
        }
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

    public function addDynamicRules()
    {
        array_push($this->rules['model'],'unique:items,model,NULL,id,brand_id,'.$this->brand_id);//vérifie si le model n'existe pas déjà pour la marque sélectionner
    }
}