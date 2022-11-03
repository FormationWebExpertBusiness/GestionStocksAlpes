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


    public $selectedCategoryFilter = [];
    public $selectedBrandFilter = [];

    public $isFormOpen = false;

    protected $rules = [
        'category_id' => ['nullable', 'integer'],
        'brand_id' => ['nullable', 'integer'],
        'model' => ['required'],
        'unit' => ['nullable'],
        'photo_item' => ['image'],

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
    ];

    public function mount()
    {
        $this->category_id = $this->commonItemToUpdate?->category_id ?? 1;
        $this->brand_id = $this->commonItemToUpdate?->brand_id ?? 1;
        $this->model = $this->commonItemToUpdate?->model;
        $this->unit = $this->commonItemToUpdate?->unit;
        $this->photo_item = $this->commonItemToUpdate?->photo_item;

        $this->brands = Brand::all();
        $this->categories = Category::all();
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
    }

    public function saveCommonItem()
    {

        if (empty($this->commonItemToUpdate) || ($this->brand_id !== $this->commonItemToUpdate->brand_id || $this->model !== $this->commonItemToUpdate->model)) {
            $this->addDynamicRules();
        }
        $validatedData = $this->validate();

        $photo = $this->photo_item->store('public');
        $validatedData['photo_item'] = $photo;

        // dd($this->photo_item);
        // $validatedData ['photo_item'] = 'public/'.$this->photo_item->getHashNameAttribute();
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
