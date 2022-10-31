<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Rack;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class Filtres extends Component
{
    public $isVisibleCat = false;
    public $isVisibleBrand = false;
    public $isVisibleRack = false;
    public $isVisibleRackLevel = false;

    public $categories;
    public $brands;
    public $racks;
    public $rackLevels;

    public $quantityMin;
    public $quantityMax;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $racksFilter = [];
    public $rackLevelsFilter = [];

    public $search;

    protected $listeners = ['catsFilter' => 'getCatF', 'brandsFilter' => 'getBrandF', 'racksFilter' => 'getRackF', 'rackLevelsFilter' => 'getRackLevelF'];

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

    public function getRackF($rack)
    {
        $this->racksFilter = $rack;
    }

    public function getRackLevelF($rackLevel)
    {
        $this->rackLevelsFilter = $rackLevel;
    }

    public function toggleCatDropdown()
    {
        $this->isVisibleCat = ! $this->isVisibleCat;
    }

    public function toggleBrandDropdown()
    {
        $this->isVisibleBrand = ! $this->isVisibleBrand;
    }

    public function toggleRackDropdown()
    {
        $this->isVisibleRack = ! $this->isVisibleRack;
    }

    public function toggleRackLevelDropdown()
    {
        $this->isVisibleRackLevel = ! $this->isVisibleRackLevel;
    }

    public function appendCat($cat)
    {
        $this->emit('catFilter', $cat);
    }

    public function appendBrand($brand)
    {
        $this->emit('brandFilter', $brand);
    }

    public function appendRack($rack)
    {
        $this->emit('rackFilter', $rack);
    }

    public function appendRackLevel($rackLevel)
    {
        $this->emit('rackLevelFilter', $rackLevel);
    }

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->racksFilter = [];
        $this->rackLevelsFilter = [];
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

    public function render()
    {
        $this->brands = Category::getLinkedBrands($this->catsFilter);

        $this->categories = Category::all();

        $this->racks = Rack::all();

        $levelMax = Rack::getRackLevelMax($this->racksFilter);

        $this->rackLevels = collect();
        for ($i = 1; $i <= $levelMax; $i++) {
            $this->rackLevels->push($i);
        }

        return view('livewire.filtres');
    }
}
