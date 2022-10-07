<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

class ViewAll extends Component
{
    //egg
    public $displayChoregraphie = false;


    public $champ = 'id';
    public $mode = 'asc';

    public $priceMin;
    public $priceMax;
    public $quantityMin;
    public $quantityMax;

    public $searchValue = "";

    public $categoriesF = array();
    public $brandsF = array();

    protected $queryString = [
        'champ' => ['except' => 'id', 'as' => 'cha'],
        'mode' => ['as' => 'mod'],
        'categoriesF' => ['as' => 'cat'],
        'brandsF' => ['as' => 'bra']
    ];

    protected $listeners = [
        'stockUpdated' => 'reloadView',
        'catFilter' => 'updateCatF',
        'brandFilter' => 'updateBrandF',
        'resetFilters' => 'resetAllFilters',
        'searchF' => 'search',
        'resetSearchBar' => 'resetValueSearchBar',
        'priceMin' => 'getPriceMin',
        'priceMax' => 'getPriceMax',
        'quantityMin' => 'getQuantityMin',
        'quantityMax' => 'getQuantityMax'
    ];

    protected $nbCol = 5; //le nombre de colonne sans compter les icones

    public function mount()
    {
        $this->priceMin = Item::min('price');
        $this->priceMax = Item::max('price');

        $this->quantityMin = Item::min('quantity');
        $this->quantityMax = Item::max('quantity');

        $this->categoriesF = array();
        $this->brandsF = array();
    }

    public function getPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;
    }

    public function getPriceMax($priceMax)
    {
        $this->priceMax = $priceMax;
    }

    public function getQuantityMin($quantityMin)
    {
        $this->quantityMin = $quantityMin;
    }

    public function getQuantityMax($quantityMax)
    {
        $this->quantityMax = $quantityMax;
    }

    public function deleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        $item->delete();
        return redirect();
    }

    public function resetValueSearchBar()
    {
        $this->searchValue = "";
    }

    public function updateCatF($cat)
    {
        if(in_array($cat, $this->categoriesF))
        {
            unset($this->categoriesF[array_search($cat, $this->categoriesF)]);
        }else{
            array_push($this->categoriesF, $cat);
        }

        $this->emit("catsFilter", $this->categoriesF);
    }

    public function updateBrandF($brand)
    {
        if(in_array($brand, $this->brandsF))
        {
            unset($this->brandsF[array_search($brand, $this->brandsF)]);
        }else{
            array_push($this->brandsF, $brand);
        }

        $this->emit("brandsFilter", $this->brandsF);
    }

    public function toggleMode()
    {
        if ($this->mode == 'asc') {
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
        $this->categoriesF = array();
        $this->brandsF = array();

        $this->priceMin = Item::min('price');
        $this->priceMax = Item::max('price');

        $this->quantityMin = Item::min('quantity');
        $this->quantityMax = Item::max('quantity');
    }

    public function search($searchV)
    {
        $this->searchValue = $searchV;
    }
    
    public function render()
    {
        $items = Item::where('items.id', '>', 0)
        ->join('brands as brand', 'brand.id', '=', 'items.brand_id')
        ->join('categories as category', 'category.id', '=', 'items.category_id')
        ->join('items as ite', 'ite.id', '=', 'items.id') // I joined items on items because else eloquent erase the items id to replace it with the last joined table id 
        ->where('items.model','LIKE','%'.$this->searchValue.'%')
        ->orWhere('items.comment','LIKE','%'.$this->searchValue.'%')
        ->orWhere('category.name','LIKE','%'.$this->searchValue.'%')
        ->orWhere('brand.name','LIKE','%'.$this->searchValue.'%')
        ->where([
            ['items.price', '<=', $this->priceMax],
            ['items.price', '>=', $this->priceMin],
            ['items.quantity', '<=', $this->quantityMax],
            ['items.quantity', '>=', $this->quantityMin]
        ])
        ->orderBy(($this->champ == 'category' || $this->champ == 'brand') ? $this->champ.'.name' : 'items.'.$this->champ, $this->mode) // if champ is category or brand order on champ.name instead of champ
        ->get()
        ->filter(function ($value) {
            $catF = empty($this->categoriesF) ? Category::where('id' ,'>' ,0)->pluck('id')->toArray() : $this->categoriesF;
            $brandF = empty($this->brandsF) ? Brand::where('id' ,'>' ,0)->pluck('id')->toArray() : $this->brandsF;

            if(in_array($value->category->id, $catF) && in_array($value->brand->id, $brandF))
            {
                if($value->price >= $this->priceMin && $value->price <= $this->priceMax)
                {
                    if($value->quantity >= $this->quantityMin && $value->quantity <= $this->quantityMax)
                    {
                        return $value;
                    }
                }
            }
        });

        $this->displayChoregraphie = $this->searchValue == 'chorégraphie';

        return view('livewire.view-all', [
            'items' => $items
        ]);
    }

    public function redirectChoregraphie()
    {
        return redirect('https://youtu.be/2ZNklVhqi7I?t=16');
    }

    public function reloadView()
    {
        return redirect();
    }

    public function getDataColumnWidth()
    {
        return 'w-['.((1 / ($this->nbCol + 2)) * 100).'%]';
    }
}
