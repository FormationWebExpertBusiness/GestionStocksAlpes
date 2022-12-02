<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CommonProduct;
use Livewire\Component;

class Dashboard extends Component
{
    public $commonProducts;
    public $search;
    public $isVisibleCat = false;
    public $categories;

    public $catsFilter = [];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function toggleCatDropdown()
    {
        $this->isVisibleCat = ! $this->isVisibleCat;
    }

    public function render()
    {
        $this->categories = Category::all();
        $this->commonProducts = CommonProduct::select('common_products.*')
            ->join('categories', 'categories.id', '=', 'common_products.category_id')
            ->where('categories.name', 'like', '%' . $this->search . '%', )
            ->where('favorite', '=', true)
            ->get();
        $catF = count($this->catsFilter) === 0 ? Category::where('id', '>', 0)->pluck('id')->toArray() : $this->catsFilter;
        $this->commonProducts = CommonProduct::filterOnCategories($this->commonProducts, $catF);
        //dump($this->commonProducts);
        return view('livewire.dashboard')->layout('layout');
    }
}
