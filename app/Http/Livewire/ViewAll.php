<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use App\Models\Rack;
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
        'priceMin' => 'getPriceMin',
        'priceMax' => 'getPriceMax',
        'quantityMin' => 'getQuantityMin',
        'quantityMax' => 'getQuantityMax',
        'deleteItem' => 'deleteItem',
    ];

    public function mount()
    {
        $this->priceMin = CommonItem::all()->min('totalPrice') ?? 0;
        $this->priceMax = CommonItem::all()->max('totalPrice') ?? 0;

        $this->quantityMin = CommonItem::all()->min('quantity') ?? 0;
        $this->quantityMax = CommonItem::all()->max('quantity') ?? 0;

        $this->categoriesF = [];
        $this->brandsF = [];
        $this->racksF = [];
        $this->rackLevelsF = [];
    }

    public function getPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;
    }

    public function getPriceMax($priceMax)
    {
        if ($priceMax === "") {
            $priceMax = CommonItem::all()->max('totalPrice');
        }
        $this->priceMax = $priceMax;
    }

    public function openWarningDelete($itemId)
    {
        $this->emit('deleteWarning', $itemId, $this->warningDeleteItemSignal, 'Item', 'model');
    }

    public function getQuantityMin($quantityMin)
    {
        $this->quantityMin = $quantityMin;
    }

    public function getQuantityMax($quantityMax)
    {
        if ($quantityMax === "") {
            $quantityMax = CommonItem::all()->max('quantity');
        }
        $this->quantityMax = $quantityMax;
    }

    public function deleteItem($itemId)
    {
        $item = CommonItem::findOrFail($itemId);
        $item->delete();
        return redirect()->with('status', 'Le produit '.$item->model.' a bien été supprimé !');
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

        $this->priceMin = CommonItem::all()->min('totalPrice') ?? 0;
        $this->priceMax = CommonItem::all()->max('totalPrice') ?? 0;

        $this->quantityMin = CommonItem::all()->min('quantity') ?? 0;
        $this->quantityMax = CommonItem::all()->max('quantity') ?? 0;
    }

    public function search($searchV)
    {
        $this->searchValue = $searchV;
    }

    public function render()
    {
        $items = CommonItem::where('common_items.id', '>', 0)
            ->join('brands as brand', 'brand.id', '=', 'common_items.brand_id')
            ->join('categories as category', 'category.id', '=', 'common_items.category_id')
            //->join('items as ite', 'ite.common_id', '=', 'common_items.id')
            ->join('common_items as comi', 'comi.id', '=', 'common_items.id') // I joined items on items because else eloquent erase the items id to replace it with the last joined table id
            ->where('common_items.model', 'LIKE', '%'.$this->searchValue.'%')
            ->orWhere('category.name', 'LIKE', '%'.$this->searchValue.'%')
            ->orWhere('brand.name', 'LIKE', '%'.$this->searchValue.'%')
            // ->where([
            //     ['items.price', '<=', $this->priceMax],
            //     ['items.price', '>=', $this->priceMin],
            //     ['items.quantity', '<=', $this->quantityMax],
            //     ['items.quantity', '>=', $this->quantityMin],
            // ])
            // ->groupBy('common_items.id')
            // ->groupBy('ite.price')
            // ->groupBy('ite.id')
            // ->havingRaw('SUM(ite.price) <= ?', [$this->priceMax])
            // ->havingRaw('SUM(ite.price) >= ?', [$this->priceMin])
            // ->havingRaw('COUNT(ite.id) <= ?', [$this->quantityMax])
            // ->havingRaw('COUNT(ite.id) >= ?', [$this->quantityMin])
            //->orderBy($this->champ === 'category' || $this->champ === 'brand' ? $this->champ.'.name' : 'common_items.'.$this->champ, $this->mode) // if champ is category or brand order on champ.name instead of champ
            ->get()
            ->filter(function ($value) {
                $catF = empty($this->categoriesF) ? Category::where('id', '>', 0)->pluck('id')->toArray() : $this->categoriesF;
                $brandF = empty($this->brandsF) ? Brand::where('id', '>', 0)->pluck('id')->toArray() : $this->brandsF;
                
                //not use
                /*$rackF = empty($this->racksF) ? Rack::where('id', '>', 0)->pluck('id')->toArray() : $this->racksF;
                $rackLevelF = [];
                if (empty($this->rackLevelsF)) {
                    for ($i=1; $i <= Rack::all()->max('nb_level'); $i++) { 
                        $rackLevelF[] = $i;
                    }
                }
                else {
                    $rackLevelF = $this->rackLevelsF; 
                }
                if (in_array($value->category->id, $catF) && in_array($value->brand->id, $brandF) && in_array($value->rack->id, $rackF) && in_array($value->rack_level, $rackLevelF)) {
                */
                
                if (in_array($value->category->id, $catF) && in_array($value->brand->id, $brandF)) {
                    if ($value->totalPrice >= $this->priceMin && $value->totalPrice <= $this->priceMax) {
                        if ($value->quantity >= $this->quantityMin && $value->quantity <= $this->quantityMax) {
                            return $value;
                        }
                    }
                }
            })
            ->sortBy([[$this->champ === 'category' || $this->champ === 'brand' ? $this->champ.'.name' : $this->champ, $this->mode]]);
            
        $this->showToast = true;

        return view('livewire.view-all', [
            'commonItems' => $items,
        ]);
    }

    public function reloadView()
    {
        return redirect();
    }
}
