<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class ViewAll extends Component
{
    public $isCreatingNewItem = false;


    public $champ = 'id';
    public $mode = 'asc';

    public $categoriesF = array();
    public $brandsF = array();

    protected $queryString = ['champ', 'mode', 'categoriesF', 'brandsF'];

    protected $listeners = ['stockUpdated' => 'reloadView', 'catFilter' => 'updateCatF', 'brandFilter' => 'updateBrandF'];

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
    }

    public function updateBrandF($brand)
    {
        if(in_array($brand, $this->brandsF))
        {
            unset($this->brandsF[array_search($brand, $this->brandsF)]);
        }else{
            array_push($this->brandsF, $brand);
        }
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
        } else {
            $items = Item::orderBy($this->champ, $this->mode)->get();
        }

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
}
