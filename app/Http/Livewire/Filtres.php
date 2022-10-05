<?php

namespace App\Http\Livewire;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class Filtres extends Component
{
    public $isVisibleCat = false;
    public $isVisibleBrand = false;

    public $categories;
    public $brands;

    public $catsFilter = array();
    public $brandsFilter = array();

    protected $listeners = ['catsFilter' => 'getCatF', 'brandsFilter' => 'getBrandF'];

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
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
        $this->isVisibleCat = !$this->isVisibleCat;
        if($this->isVisibleBrand == true) $this->isVisibleBrand = !$this->isVisibleBrand;
    }

    public function toggleBrandDropdown()
    {
        $this->isVisibleBrand = !$this->isVisibleBrand;
        if($this->isVisibleCat == true) $this->isVisibleCat = !$this->isVisibleCat;
    }

    public function appendCat($cat)
    {
        $this->emit("catFilter", $cat);
    }

    public function appendBrand($brand)
    {
        $this->emit("brandFilter", $brand);
    }

    public function render(Request $request)
    {
        // if($this->catsFilter != null) dd($this->catsFilter);
        return view('livewire.filtres');
    }
}
