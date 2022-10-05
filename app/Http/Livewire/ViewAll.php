<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brand;

class ViewAll extends Component
{
    public $isCreatingNewItem = false;


    public $champ = 'id';
    public $mode = 'asc';

    public $categoriesF = array();
    public $brandsF = array();

    protected $queryString = [
        'champ' => ['except' => 'id', 'as' => 'cha'],
        'mode' => ['as' => 'mod'],
        'categoriesF' => ['as' => 'cat'],
        'brandsF' => ['as' => 'bra']
    ];

    protected $listeners = ['stockUpdated' => 'reloadView', 'catFilter' => 'updateCatF', 'brandFilter' => 'updateBrandF'];

    protected $nbCol = 5;//le nombre de colonne sans compter les icones

    public function deleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        $item->delete();
        return redirect();
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

    public function render()
    {
        if ($this->champ == 'category' || $this->champ == 'brand') {
            $items = Item::all();
            if ($this->mode == 'asc') {
                $items = $items->sortBy(function ($item) {
                    $champF = $this->champ;
                    return $item->$champF->name;
                }, SORT_NATURAL | SORT_FLAG_CASE);
            } else {
                $items = $items->sortByDesc(function ($item) {
                    $champF = $this->champ;
                    return $item->$champF->name;
                }, SORT_NATURAL | SORT_FLAG_CASE);
            }
            // Test 2
            // $items = Item::all()->sortBy(function($item) {
            //     $champF = $this->champ;
            //     return $item->$champF->name;
            // }, SORT_NATURAL | SORT_FLAG_CASE, $this->mode);
            // Test 3
            // $champPlur = $this->champ == "category" ? "categories" : "brands";
            // $items = Item::where('items.id', '>', 0)->join($champPlur, $champPlur.'.id', '=', 'items.'.$this->champ.'_id')->orderBy($champPlur.'.name')->get();
        } else {
            $items = Item::orderBy($this->champ, $this->mode)->get();
        }

        $items = $items->filter(function ($value) {
            $catF = empty($this->categoriesF) ? Category::where('id' ,'>' ,0)->pluck('id')->toArray() : $this->categoriesF;
            $brandF = empty($this->brandsF) ? Brand::where('id' ,'>' ,0)->pluck('id')->toArray() : $this->brandsF;
            if(in_array($value->category->id, $catF) && in_array($value->brand->id, $brandF)) return $value;
        });
         
        $items->all();

        return view('livewire.view-all', [
            'items' => $items
        ]);
    }

    public function toggleAddForm()
    {
        $this->isCreatingNewItem = !$this->isCreatingNewItem;
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
