<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use Livewire\Component;

class ViewAll extends Component
{
    public $champ = 'id';
    public $mode = 'asc';

    public $quantityMin;
    public $quantityMax;

    public $searchValue = '';

    public $warningDeleteItemSignal = 'deleteItem';

    public $categoriesF = [];
    public $brandsF = [];
    public $racksF = [];
    public $rackLevelsF = [];

    public $commonItems;

    public $showToast = true;

    protected $queryString = [
        'champ' => ['except' => 'id', 'as' => 'cha'],
        'mode' => ['as' => 'mod'],
        'categoriesF' => ['as' => 'cat'],
        'brandsF' => ['as' => 'bra'],
        'racksF' => ['as' => 'rac'],
        'rackLevelsF' => ['as' => 'rlv'],
        'searchValue' => ['except' => '', 'as' => 'sea'],
        'quantityMin' => ['except' => '', 'as' => 'qmin'],
        'quantityMax' => ['except' => '', 'as' => 'qmax'],
    ];

    protected $listeners = [
        'stockUpdated' => 'reloadView',
        'catsFilter' => 'updateCatF',
        'brandsFilter' => 'updateBrandF',
        'racksFilter' => 'updateRackF',
        'rackLevelsFilter' => 'updateRackLevelF',
        'resetFilters' => 'resetAllFilters',
        'searchF' => 'search',
        'quantityMin' => 'getQuantityMin',
        'quantityMax' => 'getQuantityMax',
        'deleteItem' => 'deleteItem',
    ];

    public function mount()
    {

    }

    public function openWarningDelete($commonItemId)
    {
        $deleteMessage = '';
        if (CommonItem::find($commonItemId)->hasItem()) {
            $deleteMessage = '⚠️ Des produits existent dans le stock, si vous supprimez, les produits seront aussi supprimés';
        }
        $this->emit('deleteWarning', $commonItemId, $this->warningDeleteItemSignal, 'CommonItem', 'model', $deleteMessage);
    }

    public function deleteItem($commonItemId)
    {
        $commonItem = CommonItem::findOrFail($commonItemId);
        $commonItem->delete();
        return redirect()->with('status', 'Le produit '.$commonItem->model.' a bien été supprimé !');
    }

    public function closeToast()
    {
        $this->showToast = false;
    }

    public function getQuantityMin($quantityMin)
    {
        $this->quantityMin = $quantityMin;
    }

    public function getQuantityMax($quantityMax)
    {
        $this->quantityMax = $quantityMax;
    }

    public function updateCatF($cats)
    {
        $this->categoriesF = $cats;
    }

    public function updateBrandF($brands)
    {
           $this->brandsF = $brands;
    }

    public function updateRackF($racks)
    {
        $this->racksF = $racks;
    }

    public function updateRackLevelF($rackLevels)
    {
        $this->rackLevelsF = $rackLevels;
    }

    public function search($searchV)
    {
        $this->searchValue = $searchV;
    }

    public function resetAllFilters()
    {
        $this->categoriesF = [];
        $this->brandsF = [];
        $this->racksF = [];
        $this->rackLevelsF = [];

        $this->quantityMin = null;
        $this->quantityMax = null;
    }

    public function toggleMode()
    {
        if ($this->mode === 'asc') {
            $this->mode = 'desc';
        } else {
            $this->mode = 'asc';
        }
    }

    public function reOrder($champO)
    {
        $this->toggleMode();
        $this->champ = $champO;
    }

    public function FilterOnSearchBar()
    {
        if ($this->searchValue) {
            $this->commonItems = CommonItem::select('common_items.*')
            ->join('brands', 'common_items.brand_id', '=', 'brands.id')
            ->join('categories', 'common_items.category_id', '=', 'categories.id')
            ->where('common_items.model', 'LIKE', '%'.$this->searchValue.'%')
            ->orWhere('categories.name', 'LIKE', '%'.$this->searchValue.'%')
            ->orWhere('brands.name', 'LIKE', '%'.$this->searchValue.'%')
            ->get();
        } else {
            $this->commonItems = CommonItem::all();
        }
    }

    public function sortCommonItems(){

        switch ($this->champ) {
            case 'category':
                $this->commonItems = CommonItem::SortOnCategories($this->commonItems, $this->mode);
                break;
            case 'brand':
                $this->commonItems = CommonItem::SortOnBrands($this->commonItems, $this->mode);
                break;
            case 'model':
                $this->commonItems = CommonItem::SortOnModels($this->commonItems, $this->mode);
                break;
            case 'quantity':
                $this->commonItems = CommonItem::SortOnQuantitiesOnRack($this->commonItems, $this->mode, $this->racksF, $this->rackLevelsF);
                break;
            case 'price':
                $this->commonItems = CommonItem::SortOnTotalPricesOnRack($this->commonItems, $this->mode, $this->racksF, $this->rackLevelsF);
                break;
        }
    }

    public function render()
    {
        $this->FilterOnSearchBar();
        $this->commonItems = CommonItem::FilterOnBrands($this->commonItems, $this->brandsF);
        $this->commonItems = CommonItem::FilterOnCategories($this->commonItems, $this->categoriesF);
        if ($this->racksF || $this->rackLevelsF) {
            $this->commonItems = CommonItem::FilterOnRacksQuantities($this->commonItems, $this->quantityMin, $this->quantityMax, $this->racksF, $this->rackLevelsF);
        } else {
            $this->commonItems = CommonItem::FilterOnQuantities($this->commonItems, $this->quantityMin, $this->quantityMax);
        }
        $this->sortCommonItems();

        $this->showToast = true;

        return view('livewire.view-all');
    }

    public function reloadView()
    {
        return redirect();
    }
}
