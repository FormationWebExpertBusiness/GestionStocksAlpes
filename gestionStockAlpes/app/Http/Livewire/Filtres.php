<?php

namespace App\Http\Livewire;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;

class Filtres extends Component
{
    public $isVisibleCat = false;
    public $isVisibleBrand = false;

    public $categories;
    public $brands;


    public function toggleCatDropdown()
    {
        $this->isVisibleCat = !$this->isVisibleCat;
        if($this->isVisibleBrand == true) $this->isVisibleBrand = !$this->isVisibleBrand;
    }

    public function toggleBrandDropdown()
    {
        $this->isVisibleBrand = !$this->isVisibleBrand;
        if($this->isVisibleCat == true) $this->isVisibleCat = !$this->isVisibleCat;
    }

    public function render()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        return view('livewire.filtres');
    }
}
