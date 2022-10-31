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

    public $priceMin;
    public $priceMax;
    public $quantityMin;
    public $quantityMax;

    public $searchValue = '';

    public $warningDeleteItemSignal = 'deleteItem';

    public $categoriesF = [];
    public $brandsF = [];
    public $racksF = [];
    public $rackLevelsF = [];

    public $showToast = true;

    protected $queryString = [
        'champ' => ['except' => 'id', 'as' => 'cha'],
        'mode' => ['as' => 'mod'],
        'categoriesF' => ['as' => 'cat'],
        'brandsF' => ['as' => 'bra'],
        'racksF' => ['as' => 'rac'],
        'rackLevelsF' => ['as' => 'rlv'],
        'searchValue' => ['except' => '', 'as' => 'sea'],
    ];

    protected $listeners = [
        'stockUpdated' => 'reloadView',
        'catsFilter' => 'updateCatF',
        'brandsFilter' => 'updateBrandF',
        'racksFilter' => 'updateRackF',
        'rackLevelsFilter' => 'updateRackLevelF',
        'resetFilters' => 'resetAllFilters',
        'searchF' => 'search',
        'priceMin' => 'getPriceMin',
        'priceMax' => 'getPriceMax',
        'quantityMin' => 'getQuantityMin',
        'quantityMax' => 'getQuantityMax',
        'deleteItem' => 'deleteItem',
    ];

    public function mount()
    {
        $this->priceMin = 0;
        $this->priceMax = CommonItem::all()->max('totalPrice') ?? 0;

        $this->quantityMax = $this->quantityMax ?? CommonItem::all()->max('quantity');
    }

    public function getPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;
    }

    public function getPriceMax($priceMax)
    {
        if ($priceMax === '') {
            $priceMax = CommonItem::all()->max('totalPrice');
        }
        $this->priceMax = $priceMax;
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
        if ($quantityMax === '') {
            $quantityMax = CommonItem::all()->max('quantity');
        }
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

        $this->priceMin = 0;
        $this->priceMax = CommonItem::all()->max('totalPrice') ?? 0;

        $this->quantityMin = 0;
        $this->quantityMax = CommonItem::all()->max('quantity') ?? 0;
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

    public function render()
    {
        $commonItems = CommonItem::where('common_items.id', '>', 0)
            ->join('brands as brand', 'brand.id', '=', 'common_items.brand_id')
            ->join('categories as category', 'category.id', '=', 'common_items.category_id')
            ->join('common_items as comi', 'comi.id', '=', 'common_items.id') // I joined items on items because else eloquent erase the items id to replace it with the last joined table id
            ->where('common_items.model', 'LIKE', '%'.$this->searchValue.'%')
            ->orWhere('category.name', 'LIKE', '%'.$this->searchValue.'%')
            ->orWhere('brand.name', 'LIKE', '%'.$this->searchValue.'%')
            ->get()
            ->filter(function ($value) {
                $catF = empty($this->categoriesF) ? Category::where('id', '>', 0)->pluck('id')->toArray() : $this->categoriesF;
                $brandF = empty($this->brandsF) ? Brand::where('id', '>', 0)->pluck('id')->toArray() : $this->brandsF;

                if (in_array($value->category->id, $catF) && in_array($value->brand->id, $brandF)) {
                    if ($value->TotalPriceOnRack($this->racksF, $this->rackLevelsF) >= $this->priceMin
                        && $value->TotalPriceOnRack($this->racksF, $this->rackLevelsF) <= $this->priceMax) {
                        if ($value->QuantityOnRack($this->racksF, $this->rackLevelsF) >= $this->quantityMin
                            && $value->QuantityOnRack($this->racksF, $this->rackLevelsF) <= $this->quantityMax) {
                            if (! $this->racksF && ! $this->rackLevelsF) {
                                return $value;
                            } else {
                                if ($value->QuantityOnRack($this->racksF, $this->rackLevelsF) > 0) {
                                    return $value;
                                }
                            }
                        }
                    }
                }
            })
            ->sortBy([[$this->champ === 'category' || $this->champ === 'brand' ? $this->champ.'.name' : $this->champ, $this->mode]]);

        $this->showToast = true;

        return view('livewire.view-all', [
            'commonItems' => $commonItems,
        ]);
    }

    public function reloadView()
    {
        return redirect();
    }
}
