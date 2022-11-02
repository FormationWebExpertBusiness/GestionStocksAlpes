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
        elseif (substr($propertyName,-6) === 'Filter') {
            $this->emit($propertyName, $this->$propertyName);
        }
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
        $this->getSearchInput();
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
