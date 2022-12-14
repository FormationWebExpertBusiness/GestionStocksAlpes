<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CommonProduct;
use Illuminate\Support\Str;
use Livewire\Component;

class Filtres extends Component
{
    public $isVisibleCat = false;
    public $isVisibleBrand = false;
    public $isVisibleStatus = false;

    public $categories;
    public $brands;
    public $statutes;

    public $quantityMin;
    public $quantityMax;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $statutesFilter = [];

    public $searchFilter;

    protected $messages = [
        'quantityMin.integer' => 'La quantité doit être un entier',
        'quantityMax.integer' => 'La quantité doit être un entier',
        'quantityMin.min' => 'La quantité min doit être supérieur à 0',
        'quantityMax.min' => 'La quantité max doit être supérieur à la quantité min',
    ];

    public function updated($propertyName)
    {
        $rules = [
            'quantityMin' => 'nullable|integer|min:0',
            'quantityMax' => 'nullable|integer|min:'.$this->quantityMin,
        ];
        if ($propertyName === 'quantityMin' || $propertyName === 'quantityMax') {
            $propertyTrueName = $propertyName;
            $propertyName = Str::remove('Min', $propertyName);
            $propertyName = Str::remove('Max', $propertyName);
            $this->resetErrorBag();
            $this->validateOnly($propertyName.'Min', $rules);
            $this->validateOnly($propertyName.'Max', $rules);

            $this->emit($propertyTrueName, $this->$propertyTrueName);
        } elseif (substr($propertyName, -6) === 'Filter') {
            $this->emit($propertyName, $this->$propertyName);
        }
    }

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->statutesFilter = [];
        $this->quantityMin = null;
        $this->quantityMax = null;

        $this->emit('resetFilters');
    }

    public function getAllFilters()
    {
        $catsFilter = [];
        $brandsFilter = [];
        $statutesFilter = $this->statutesFilter;
        foreach ($this->catsFilter as $filter) {
            $catsFilter[] = $this->categories->where('id', $filter)->first()->name;
        }

        foreach ($this->brandsFilter as $filter) {
            $brandsFilter[] = $this->brands->where('id', $filter)->first()->name;
        }

        return array_merge($catsFilter, $brandsFilter, $statutesFilter);
    }

    public function resetSearchBar()
    {
        $this->search = '';
        $this->emit('searchFilter', $this->search);
    }

    public function render()
    {
        $this->brands = Category::getLinkedBrands($this->catsFilter);

        $this->categories = Category::all();

        $this->statutes = CommonProduct::$statutesQuantity;

        return view('livewire.filtres');
    }
}
