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
            $f = $this->categories->where('id', $filter)->first();
            $f->badge = $f->name;
            $catsFilter[] = $f;
        }

        foreach ($this->brandsFilter as $filter) {
            $f = $this->brands->where('id', $filter)->first();
            $f->badge = $f->name;
            $brandsFilter[] = $f;
        }

        foreach ($this->commonProductsFilter as $filter) {
            $f = $this->commonProducts->where('id', $filter)->first();
            $f->badge = $f->model;
            $commonProductsFilter[] = $f;
        }

        foreach ($this->racksFilter as $filter) {
            $f = $this->racks->where('id', $filter)->first();
            $f->badge = $f->name;
            $racksFilter[] = $f;
        }

        foreach ($this->rackLevelsFilter as $filter) {
            $f = collect(['id' => $filter, 'badge' => 'Étage '.$filter]);
            $rackLevelsFilter[] = $f;
        }

        return ['catsFilter' => $catsFilter, 'brandsFilter' => $brandsFilter, 'commonProductsFilter' => $commonProductsFilter, 'racksFilter' => $racksFilter, 'rackLevelsFilter' => $rackLevelsFilter];
    }

    public function resetSearchBar()
    {
        $this->search = '';
    }

    public function removeFilter($filter, $arrayFilterName)
    {
        $filterKey = array_search($filter['id'], $this->$arrayFilterName);
        if ($filterKey !== false) {
            unset($this->$arrayFilterName[$filterKey]);
            $this->emit($arrayFilterName, $this->$arrayFilterName);
        }
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
