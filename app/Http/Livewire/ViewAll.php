<?php

namespace App\Http\Livewire;

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
    ];

    protected $listeners = [
        'stockUpdated' => 'reloadView',
        'catFilter' => 'updateCatF',
        'brandFilter' => 'updateBrandF',
        'rackFilter' => 'updateRackF',
        'rackLevelFilter' => 'updateRackLevelF',
        'resetFilters' => 'resetAllFilters',
        'searchF' => 'search',
        'resetSearchBar' => 'resetValueSearchBar',
        'quantityMin' => 'getQuantityMin',
        'quantityMax' => 'getQuantityMax',
        'deleteItem' => 'deleteItem',
    ];

    public function mount()
    {
        $this->quantityMin = 0;
        $this->quantityMax = CommonItem::all()->max('quantity') ?? 0;

        $this->categoriesF = [];
        $this->brandsF = [];
        $this->racksF = [];
        $this->rackLevelsF = [];
    }

    public function openWarningDelete($commonItemId)
    {
        $deleteMessage = '';
        if (CommonItem::find($commonItemId)->hasItem()) {
            $deleteMessage = '⚠️ Des produits existent dans le stock, si vous supprimez, les produits seront aussi supprimés';
        }
        $this->emit('deleteWarning', $commonItemId, $this->warningDeleteItemSignal, 'CommonItem', 'model', $deleteMessage);
    }

    public function getQuantityMin($quantityMin)
    {
        $this->quantityMin = $quantityMin;
    }

    public function getQuantityMax($quantityMax)
    {
        if ($quantityMax === '') {
            $quantityMax = CommonItem::all()->max('quantity');
        }
        $this->quantityMax = $quantityMax;
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

    public function resetValueSearchBar()
    {
        $this->searchValue = '';
    }

    public function updateCatF($cat)
    {
        if (in_array($cat, $this->categoriesF)) {
            unset($this->categoriesF[array_search($cat, $this->categoriesF)]);
        } else {
            array_push($this->categoriesF, $cat);
        }

        $this->emit('catsFilter', $this->categoriesF);
    }

    public function updateBrandF($brand)
    {
        if (in_array($brand, $this->brandsF)) {
            unset($this->brandsF[array_search($brand, $this->brandsF)]);
        } else {
            array_push($this->brandsF, $brand);
        }

        $this->emit('brandsFilter', $this->brandsF);
    }

    public function updateRackF($rack)
    {
        if (in_array($rack, $this->racksF)) {
            unset($this->racksF[array_search($rack, $this->racksF)]);
        } else {
            array_push($this->racksF, $rack);
        }

        $this->emit('racksFilter', $this->racksF);
    }

    public function updateRackLevelF($rackLevel)
    {
        if (in_array($rackLevel, $this->rackLevelsF)) {
            unset($this->rackLevelsF[array_search($rackLevel, $this->rackLevelsF)]);
        } else {
            array_push($this->rackLevelsF, $rackLevel);
        }

        $this->emit('rackLevelsFilter', $this->rackLevelsF);
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

    public function resetAllFilters()
    {
        $this->categoriesF = [];
        $this->brandsF = [];
        $this->racksF = [];
        $this->rackLevelsF = [];

        $this->quantityMin = 0;
        $this->quantityMax = CommonItem::all()->max('quantity') ?? 0;
    }

    public function search($searchV)
    {
        $this->searchValue = $searchV;
    }

    public function filterOnSearchBar()
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

    public function sortCommonItems()
    {
        switch ($this->champ) {
            case 'category':
                $this->commonItems = CommonItem::sortOnCategories($this->commonItems, $this->mode);
                break;
            case 'brand':
                $this->commonItems = CommonItem::sortOnBrands($this->commonItems, $this->mode);
                break;
            case 'model':
                $this->commonItems = CommonItem::sortOnModels($this->commonItems, $this->mode);
                break;
            case 'quantity':
                $this->commonItems = CommonItem::sortOnQuantitiesOnRack($this->commonItems, $this->mode, $this->racksF, $this->rackLevelsF);
                break;
            case 'price':
                $this->commonItems = CommonItem::sortOnTotalPricesOnRack($this->commonItems, $this->mode, $this->racksF, $this->rackLevelsF);
                break;
        }
    }

    public function render()
    {
        $this->filterOnSearchBar();
        $this->commonItems = CommonItem::filterOnBrands($this->commonItems, $this->brandsF);
        $this->commonItems = CommonItem::filterOnCategories($this->commonItems, $this->categoriesF);
        if ($this->racksF || $this->rackLevelsF) {
            $this->commonItems = CommonItem::filterOnRacksQuantities($this->commonItems, $this->quantityMin, $this->quantityMax, $this->racksF, $this->rackLevelsF);
        } else {
            $this->commonItems = CommonItem::filterOnQuantities($this->commonItems, $this->quantityMin, $this->quantityMax);
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
