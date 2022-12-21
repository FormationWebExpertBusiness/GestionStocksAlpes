<?php

namespace App\Http\Livewire\Filters;

use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\Rack;
use Livewire\Component;

class ProductFilters extends Component
{
    public $isVisibleCat = false;
    public $isVisibleBrand = false;
    public $isVisibleCommonProduct = false;
    public $isVisibleRack = false;
    public $isVisibleRackLevel = false;

    public $categories;
    public $brands;
    public $commonProducts;
    public $racks;
    public $rackLevels;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $commonProductsFilter = [];
    public $racksFilter = [];
    public $rackLevelsFilter = [];

    public $searchFilter;

    public function updated($propertyName)
    {
        if (substr($propertyName, -6) === 'Filter') {
            $this->emit($propertyName, $this->$propertyName);
        }
    }

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->commonProductsFilter = [];
        $this->racksFilter = [];
        $this->rackLevelsFilter = [];

        $this->emit('resetFilters');
    }

    public function getAllFilters()
    {
        $catsFilter = [];
        $brandsFilter = [];
        $commonProductsFilter = [];
        $racksFilter = [];
        $rackLevelsFilter = [];
        foreach ($this->catsFilter as $filter) {
            $catsFilter[] = $this->categories->where('id', $filter)->first()->name;
        }

        foreach ($this->brandsFilter as $filter) {
            $brandsFilter[] = $this->brands->where('id', $filter)->first()->name;
        }

        foreach ($this->commonProductsFilter as $filter) {
            $commonProductsFilter[] = $this->commonProducts->where('id', $filter)->first()->model;
        }

        foreach ($this->racksFilter as $filter) {
            $racksFilter[] = $this->racks->where('id', $filter)->first()->name;
        }

        foreach ($this->rackLevelsFilter as $filter) {
            $rackLevelsFilter[] = 'Étage '.$filter;
        }

        return array_merge($catsFilter, $brandsFilter, $commonProductsFilter, $racksFilter, $rackLevelsFilter);
    }

    public function resetSearchBar()
    {
        $this->search = '';
    }

    public function mount()
    {
        $this->categories = Category::all();

        $this->commonProducts = CommonProduct::all();

        $this->racks = Rack::all();
    }

    public function render()
    {
        $this->brands = Category::getLinkedBrands($this->catsFilter);

        $levelMax = Rack::getRackLevelMax($this->racksFilter);
        $this->rackLevels = collect();
        for ($i = 1; $i <= $levelMax; $i++) {
            $this->rackLevels->push($i);
        }
        return view('livewire.filters.product-filters');
    }
}
