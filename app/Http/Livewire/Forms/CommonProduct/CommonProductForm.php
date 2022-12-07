<?php

namespace App\Http\Livewire\Forms\CommonProduct;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonProduct;
use Livewire\Component;
use Livewire\WithFileUploads;

class CommonProductForm extends Component
{
    use WithFileUploads;

    public $categories;
    public $brands;
    public $commonProductToUpdate = null;
    public $category_id;
    public $brand_id;
    public $model;

    public $photo_product;
    public $quantity_low;
    public $quantity_critical;

    public $selectedCategoryFilter = [];
    public $selectedBrandFilter = [];

    public $isFormOpen = false;

    protected $rules = [
        'category_id' => ['nullable', 'integer'],
        'brand_id' => ['nullable', 'integer'],
        'model' => ['required'],
        'photo_product' => ['nullable','image'],
        'quantity_low' => ['nullable', 'integer', 'min:0'],
        'quantity_critical' => ['nullable', 'integer', 'min:0'],
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
        'model.required' => 'Le model ou la référence du produit doit être renseigné.',
        'photo_product.image' => 'La photo du produit doit être de type PNG,JPG,JPEG.',
        'quantity_low.integer' => 'La quantité doit être un nombre entier',
        'quantity_low.min' => 'La quantité doit être un nombre positif',
        'quantity_critical.integer' => 'La quantité doit être un nombre entier',
        'quantity_critical.min' => 'La quantité doit être un nombre positif',
    ];

    public function mount()
    {
        $this->resetInputs();

        $this->brands = Brand::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.forms.common-product.common-product-form');
    }

    public function updated($property)
    {
        if (! $this->commonProductToUpdate || in_array($property, ['model', 'brand_id'])) {
            $this->addDynamicRules();
        }

        $this->validateOnly($property);
        if ($property === 'brand_id' && isset($this->model)) {
            $this->validateOnly('model');
        }
    }

    public function saveCommonProduct()
    {
        if (! $this->commonProductToUpdate || ($this->brand_id !== $this->commonProductToUpdate->brand_id || $this->model !== $this->commonProductToUpdate->model)) {
            $this->addDynamicRules();
        }
        $validatedData = $this->validate();
        if ($this->photo_product) {
            $photo = $this->photo_product->store('public');
            $validatedData['photo_product'] = $photo;
        }

        if (!$validatedData['quantity_low']) {
            $validatedData['quantity_low'] = 0;
        }

        if (!$validatedData['quantity_critical']) {
            $validatedData['quantity_critical'] = 0;
        }

        if (isset($this->commonProductToUpdate)) {
            $this->commonProductToUpdate->update($validatedData);
        } else {
            $commonProduct = CommonProduct::create($validatedData);
        }
        $this->closeForm();
        $this->emit('stockUpdated');
        if (isset($this->commonProductToUpdate)) {
            return redirect('stock')->with('status', 'Le produit ' . $this->model . ' a bien été modifié !');
        }
        return redirect('stock')->with('status', 'Le produit ' . $commonProduct->model . ' a bien été créé !');
    }

    public function removeImage()
    {
        $this->photo_product = null;
    }

    public function closeForm()
    {
        $this->resetInputs();
        
        $this->isFormOpen = false;
    }

    public function resetInputs()
    {
        $this->category_id = $this->commonProductToUpdate?->category_id ?? 1;
        $this->brand_id = $this->commonProductToUpdate?->brand_id ?? 1;
        $this->model = $this->commonProductToUpdate?->model;
        $this->photo_product = $this->commonProductToUpdate?->photo_product ?? null;
        $this->quantity_low = $this->commonProductToUpdate?->quantity_low ?? 0;
        $this->quantity_critical = $this->commonProductToUpdate?->quantity_critical ?? 0;
    }

    public function addDynamicRules()
    {
        array_push($this->rules['model'], 'unique:common_products,model,NULL,id,brand_id,' . $this->brand_id); //vérifie si le model n'existe pas déjà pour la marque sélectionner
    }

    public function updateCatF($categories)
    {
        $this->selectedCategoryFilter = $categories;
        if (! $this->commonProductToUpdate) {
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
        if (! $this->commonProductToUpdate) {
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

        if (! $this->commonProductToUpdate) {
            $this->category_id = 1;

            $this->brand_id = 1;
        }
    }
}
