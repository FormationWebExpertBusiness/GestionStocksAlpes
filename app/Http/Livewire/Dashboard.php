<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CommonItem;
use Livewire\Component;

class Dashboard extends Component
{
    public $commonItems;
    public $search;
    public $isVisibleCat = false;
    public $categories;

    public $catsFilter = [];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function toggleCatDropdown()
    {
        $this->isVisibleCat = !$this->isVisibleCat;
    }

    public function render()
    {
        $this->categories = Category::all();
        $this->commonItems = CommonItem::select('common_items.*')
            ->join('categories', 'categories.id', '=', 'common_items.category_id')
            ->where('categories.name', 'like', '%' . $this->search . '%',)
            ->where('favorite', '=', true)
            ->get();
        $catF = empty($this->catsFilter) ? Category::where('id', '>', 0)->pluck('id')->toArray() : $this->catsFilter;
        $this->commonItems = CommonItem::FilterOnCategories($this->commonItems, $catF);
        //dump($this->commonItems);
        return view('livewire.dashboard')->layout('layout');
    }
}
