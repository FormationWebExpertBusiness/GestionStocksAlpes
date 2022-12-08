<?php

namespace App\Http\Livewire;

use App\Models\CommonProduct;
use Livewire\Component;

class Dashboard extends Component
{
    public $commonProducts;
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function toggleCatDropdown()
    {
        $this->isVisibleCat = ! $this->isVisibleCat;
    }

    public function render()
    {
        $this->commonProducts = CommonProduct::select('common_products.*')
            ->join('categories', 'categories.id', '=', 'common_products.category_id')
            ->where('categories.name', 'like', '%' . $this->search . '%')
            ->where('favorite', '=', true)
            ->orWhere('model', 'like', '%' . $this->search . '%')
            ->where('favorite', '=', true)
            ->limit(20)
            ->get();
        return view('livewire.dashboard')->layout('layout');
    }
}
