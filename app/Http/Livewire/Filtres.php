<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class Filtres extends Component
{
    public $isVisibleCat = false;
    public $isVisibleBrand = false;

    public $categories;
    public $brands;

    public $priceMin;
    public $priceMax;
    public $quantityMin;
    public $quantityMax;

    public $catsFilter = [];
    public $brandsFilter = [];

    public $search;

    protected $listeners = ['catsFilter' => 'getCatF', 'brandsFilter' => 'getBrandF'];

    protected $messages = [
        'priceMin.integer' => 'Le prix doit être un entier',
        'priceMax.integer' => 'Le prix doit être un entier',
        'priceMin.min' => 'Le prix min doit être supérieur à 0',
        'priceMax.min' => 'Le prix max doit être supérieur au prix min',
        'quantityMin.integer' => 'La quantité doit être un entier',
        'quantityMax.integer' => 'La quantité doit être un entier',
        'quantityMin.min' => 'La quantité min doit être supérieur à 0',
        'quantityMax.min' => 'La quantité max doit être supérieur à la quantité min',
    ];

    public function updated($propertyName)
    {
        $rules = [
            'priceMin' => 'nullable|integer|min:0',
            'priceMax' => 'nullable|integer|min:'.$this->priceMin,
            'quantityMin' => 'nullable|integer|min:0',
            'quantityMax' => 'nullable|integer|min:'.$this->quantityMin,
        ];
        if ($propertyName === 'quantityMin' || $propertyName === 'quantityMax' || $propertyName === 'priceMin' || $propertyName === 'priceMax') {
            $propertyTrueName = $propertyName;
            $propertyName = Str::remove('Min', $propertyName);
            $propertyName = Str::remove('Max', $propertyName);
            $this->resetErrorBag();
            $this->validateOnly($propertyName.'Min', $rules);
            $this->validateOnly($propertyName.'Max', $rules);

            $this->emit($propertyTrueName, $this->$propertyTrueName);
        }
    }

    public function getBrandF($brand)
    {
        $this->brandsFilter = $brand;
    }

    public function getCatF($cat)
    {
        $this->catsFilter = $cat;
    }

    public function toggleCatDropdown()
    {
        $this->isVisibleCat = ! $this->isVisibleCat;
        if ($this->isVisibleBrand === true) {
            $this->isVisibleBrand = ! $this->isVisibleBrand;
        }
    }

    public function toggleBrandDropdown()
    {
        $this->isVisibleBrand = ! $this->isVisibleBrand;
        if ($this->isVisibleCat === true) {
            $this->isVisibleCat = ! $this->isVisibleCat;
        }
    }

    public function appendCat($cat)
    {
        $this->emit('catFilter', $cat);
    }

    public function appendBrand($brand)
    {
        $this->emit('brandFilter', $brand);
    }

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->priceMin = null;
        $this->priceMax = null;
        $this->quantityMin = null;
        $this->quantityMax = null;

        $this->emit('resetFilters');
    }

    public function resetSearchBar()
    {
        $this->search = '';
        $this->emit('resetSearchBar');
    }

    public function getSearchInput()
    {
        $this->emit('searchF', $this->search);
    }

    public function render(Request $request)
    {
        if ($this->catsFilter) {
            $this->brands = collect();
            foreach ($this->catsFilter as $categoryKey => $categoryName) {
                $cat = Category::find($categoryName);
                $this->brands = $this->brands->merge($cat->brands)->unique('id');
            }
            $this->brands->sortBy('id');
        } else {
            $this->brands = Brand::all();
        }
        $this->categories = Category::all();

        return view('livewire.filtres');
    }
}
