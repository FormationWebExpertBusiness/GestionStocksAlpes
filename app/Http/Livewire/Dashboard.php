<?php

namespace App\Http\Livewire;

use App\Models\CommonProduct;
use Livewire\Component;

class Dashboard extends Component
{
    public $commonProducts;
    public $search;
    public $readyToLoad = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function toggleCatDropdown()
    {
        $this->isVisibleCat = ! $this->isVisibleCat;
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->commonProducts = CommonProduct::select('common_products.*')
                ->join('categories', 'categories.id', '=', 'common_products.category_id')
                ->where('categories.name', 'like', '%' . $this->search . '%')
                ->where('favorite', '=', true)
                ->orWhere('model', 'like', '%' . $this->search . '%')
                ->where('favorite', '=', true)
                ->limit(20)
                ->get();
        } else {
            $this->commonProducts = [];
        }

        return view('livewire.dashboard')->layout('layout');
    }
}
