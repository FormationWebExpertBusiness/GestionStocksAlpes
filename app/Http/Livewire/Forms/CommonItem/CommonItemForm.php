<?php

namespace App\Http\Livewire\Forms\CommonItem;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\CommonItem;
use App\Models\Rack;
use Livewire\Component;

class CommonItemForm extends Component
{
    public $categories;
    public $brands;
    // public $racks;

    public $commonItemToUpdate = null;

    public $category_id;
    public $brand_id;
    public $model;
    // public $quantity;
    public $unit;
    // public $price;
    // public $comment;
    // public $rack_id;
    // public $rack_level;

    public $selectedCategoryFilter = [];
    public $selectedBrandFilter = [];

    public $isFormOpen = false;

    protected $rules = [
        'category_id' => ['nullable', 'integer'],
        'brand_id' => ['nullable', 'integer'],
        'model' => ['required'],
        // 'quantity' => ['required', 'numeric', 'min:0'],
        'unit' => ['nullable'],
        // 'price' => ['required', 'numeric'],
        // 'comment' => ['nullable'],
        // 'rack_id' => ['required', 'integer'],
        // 'rack_level' => ['required', 'integer', 'min:1'],
    ];

    protected $listeners = [
        'catsFilter' => 'updateCatF',
        'brandsFilter' => 'updateBrandF',
        'resetFilters' => 'resetAllFilters',
    ];

    protected $messages = [
        'category_id.integer' => 'L\'élément saisi est incorrect',
        'brand_id.integer' => 'L\'élément saisi est incorrect',
        'brand_id.unique' => 'Cette marque a déjà ce model dans le stock',
        'model.unique' => 'Ce model existe déjà dans la stock pour cette marque',
        'model.required' => 'Le model ou la référence de l\'objet doit être rensigné.',
        // 'quantity.numeric' => 'La quantité doit être un nombre',
        // 'quantity.min' => 'La quantité doit être supérieur ou égale à 0',
        // 'quantity.required' => 'La quantité en stock doit être ajouté.',
        // 'price.required' => 'La valeur du stock doit être ajouté.',
        // 'price.numeric' => 'Le prix doit être un nombre',
        // 'rack_id.integer' => 'L\'élément saisi est incorrect',
        // 'rack_id.required' => 'L\'emplacement de stockage doit être saisi',
        // 'rack_level.interger' => 'le niveau de l\'étagère doit être saisie',
        // 'rack_level.required' => 'L\'emplacement de stockage doit être saisi',
    ];

    public function mount()
    {
        $this->category_id = $this->commonItemToUpdate?->category_id ?? 1;
        $this->brand_id = $this->commonItemToUpdate?->brand_id ?? 1;
        $this->model = $this->commonItemToUpdate?->model;
        // $this->quantity = $this->itemToUpdate?->quantity;
        $this->unit = $this->commonItemToUpdate?->unit;
        // $this->price = $this->itemToUpdate?->price;
        // $this->comment = $this->itemToUpdate?->comment;
        // $this->rack_id = $this->itemToUpdate?->rack_id;
        // $this->rack_level = $this->itemToUpdate?->rack_level;

        $this->brands = Brand::all();
        $this->categories = Category::all();
        // $this->racks = Rack::all();
    }

    public function render()
    {
        return view('livewire.forms.common-item.common-item-form');
    }

    public function updated($property)
    {
        if (empty($this->commonItemToUpdate) || in_array($property, ['model', 'brand_id'])) {
            $this->addDynamicRules();
        }

        $this->validateOnly($property);
        if ($property === 'brand_id' && isset($this->model)) {
            $this->validateOnly('model');
        }

        // if ($property = 'rack_id' && $this->rack_level > $this->getSelectedRack()?->nb_level) {
        //     $this->rack_level = null;
        // }
    }

    public function saveCommonItem()
    {
        if (empty($this->commonItemToUpdate) || ($this->brand_id !== $this->commonItemToUpdate->brand_id || $this->model !== $this->commonItemToUpdate->model)) {
            $this->addDynamicRules();
        }
        $validatedData = $this->validate();

        if (isset($this->commonItemToUpdate)) {
            $this->commonItemToUpdate->update($validatedData);
        } else {
            $commonItem = CommonItem::create($validatedData);
        }

        $this->closeForm();
        if (isset($this->commonItemToUpdate)) {
            return redirect('stock')->with('status', 'L\'objet '.$this->model.' a bien été modifié !');
        }
        return redirect('stock')->with('status', 'L\'objet '.$commonItem->model.' a bien été créé !');
    }

    public function closeForm()
    {
        $this->isFormOpen = false;

        $this->emit('stockUpdated');
    }

    public function addDynamicRules()
    {
        array_push($this->rules['model'], 'unique:common_items,model,NULL,id,brand_id,'.$this->brand_id);//vérifie si le model n'existe pas déjà pour la marque sélectionner
    }

    // public function getSelectedRack()
    // {
    //     return Rack::find($this->rack_id);
    // }

    public function updateCatF($categories)
    {
        $this->selectedCategoryFilter = $categories;
        if (empty($commonItemToUpdate)) {
            if (count($this->selectedCategoryFilter) === 1) {
                $this->category_id = array_values($this->selectedCategoryFilter)[0];
            } else {
                $this->category_id = $this->commonItemToUpdate?->category_id ?? 1;
            }
        }
    }
    public function updateBrandF($brands)
    {
        $this->selectedBrandFilter = $brands;
        if (empty($commonItemToUpdate)) {
            if (count($this->selectedBrandFilter) === 1) {
                $this->brand_id = array_values($this->selectedBrandFilter)[0];
            } else {
                $this->brand_id = $this->commonItemToUpdate?->category_id ?? 1;
            }
        }
    }
    public function resetAllFilters()
    {
        $this->selectedCategoryFilter = [];
        $this->selectedBrandFilter = [];

        if (empty($commonItemToUpdate)) {
            $this->category_id = $this->commonItemToUpdate?->category_id ?? 1;

            $this->brand_id = $this->commonItemToUpdate?->brand_id ?? 1;
        }
    }
}