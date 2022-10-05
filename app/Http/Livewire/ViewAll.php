<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class ViewAll extends Component
{
    public $isCreatingNewItem = false;


    public $champ = 'id';
    public $mode = 'asc';

    protected $queryString = ['champ', 'mode'];

    protected $listeners = ['stockUpdated' => 'reloadView'];

    protected $nbCol = 5;//le nombre de colonne sans compter les icones

    public function deleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        $item->delete();
        return redirect();
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

    public function getDataColumnWidth()
    {
        return 'w-['.((1 / ($this->nbCol + 2)) * 100).'%]';
    }
}
