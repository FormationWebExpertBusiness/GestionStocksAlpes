<?php

namespace App\Http\Livewire\Forms\CommonItem;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class CommonItemForm extends Component
{
    use WithFileUploads;

    public $categories;
    public $brands;
    public $commonItemToUpdate = null;
    public $category_id;
    public $brand_id;
    public $model;

    public $unit;
    public $photo_item;
    public $quantity_warning;
    public $quantity_urgent;

    public $selectedCategoryFilter = [];
    public $selectedBrandFilter = [];

    public $isFormOpen = false;

    protected $rules = [
        'category_id' => ['nullable', 'integer'],
        'brand_id' => ['nullable', 'integer'],
        'model' => ['required'],
        'unit' => ['nullable'],
        'photo_item' => ['image'],
        'quantity_warning' => ['nullable', 'integer', 'min:0'],
        'quantity_urgent' => ['nullable', 'integer', 'min:0'],
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
        'model.required' => 'Le model ou la référence de l\'objet doit être renseigné.',
        'photo_item.image' => 'La photo du produit doit être de type PNG,JPG,JPEG.',
        'quantity_warning.integer' => 'La quantité doit être un nombre entier',
        'quantity_warning.min' => 'La quantité doit être un nombre positif',
        'quantity_urgent.integer' => 'La quantité doit être un nombre entier',
        'quantity_urgent.min' => 'La quantité doit être un nombre positif',
    ];

    public function mount()
    {
        $this->category_id = $this->commonItemToUpdate?->category_id ?? 1;
        $this->brand_id = $this->commonItemToUpdate?->brand_id ?? 1;
        $this->model = $this->commonItemToUpdate?->model;
        $this->unit = $this->commonItemToUpdate?->unit;
        $this->photo_item = $this->commonItemToUpdate?->photo_item;
        $this->quantity_warning = $this->commonItemToUpdate?->quantity_warning ?? 0;
        $this->quantity_urgent = $this->commonItemToUpdate?->quantity_urgent ?? 0;

        $this->brands = Brand::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.forms.common-item.common-item-form');
    }

    public function updated($property)
    {
        if (! $this->commonItemToUpdate || in_array($property, ['model', 'brand_id'])) {
            $this->addDynamicRules();
        }

        $this->validateOnly($property);
        if ($property === 'brand_id' && isset($this->model)) {
            $this->validateOnly('model');
        }
    }

    public function saveCommonItem()
    {
        if (! $this->commonItemToUpdate || ($this->brand_id !== $this->commonItemToUpdate->brand_id || $this->model !== $this->commonItemToUpdate->model)) {
            $this->addDynamicRules();
        }
        $validatedData = $this->validate();

        $photo = $this->photo_item->store('public');
        $validatedData['photo_item'] = $photo;

        if (isset($this->commonItemToUpdate)) {
            $this->commonItemToUpdate->update($validatedData);
        } else {
            $commonItem = CommonItem::create($validatedData);
        }
        $this->closeForm();
        if (isset($this->commonItemToUpdate)) {
            return redirect('stock')->with('status', 'L\'objet ' . $this->model . ' a bien été modifié !');
        }
        return redirect('stock')->with('status', 'L\'objet ' . $commonItem->model . ' a bien été créé !');
    }

    public function closeForm()
    {
        $this->isFormOpen = false;

        $this->emit('stockUpdated');
    }

    public function addDynamicRules()
    {
        array_push($this->rules['model'], 'unique:common_items,model,NULL,id,brand_id,' . $this->brand_id); //vérifie si le model n'existe pas déjà pour la marque sélectionner
    }

    public function updateCatF($categories)
    {
        $this->selectedCategoryFilter = $categories;
        if (! $this->commonItemToUpdate) {
            if (count($this->selectedCategoryFilter) === 1) {
                $this->category_id = array_values($this->selectedCategoryFilter)[0];
            } else {
                $this->category_id = 1;
            }
        }
    }
    public function updateBrandF($brands)
    {
        $this->selectedBrandFilter = $brands;
        if (! $this->commonItemToUpdate) {
            if (count($this->selectedBrandFilter) === 1) {
                $this->brand_id = array_values($this->selectedBrandFilter)[0];
            } else {
                $this->brand_id = 1;
            }
        }
    }
    public function resetAllFilters()
    {
        $this->selectedCategoryFilter = [];
        $this->selectedBrandFilter = [];

        if (! $this->commonItemToUpdate) {
            $this->category_id = 1;

            $this->brand_id = 1;
        }
    }
}
