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

    public function deleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        $item->delete();
        return redirect();
    }

    public function toggleMode(){
        if($this->mode == 'asc'){
            $this->mode = 'desc';
        }else{
            $this->mode = 'asc';
        }
    }

    public function reOrder($champO){
        $this->toggleMode();
        $this->champ = $champO;
    }

    public function render()
    {
        if($this->champ == 'category' || $this->champ == 'brand'){
            if($this->mode == 'asc'){
                $items = Item::all();
                $items = $items->sortBy(function($item) { 
                            $champF = $this->champ;
                            return $item->$champF->name;
                        });
            }else{
                $items = Item::all();
                $items = $items->sortByDesc(function($item) { 
                            $champF = $this->champ;
                            return $item->$champF->name;
                        });
            }
        }else{
            if($this->mode == 'asc'){
                $items = Item::all();
                $items = $items->sortBy(function($item) { 
                            $champF = $this->champ;
                            return $item->$champF;
                        });
            }else{
                $items = Item::all();
                $items = $items->sortByDesc(function($item) { 
                            $champF = $this->champ;
                            return $item->$champF;
                        });
            }

        }

        return view('livewire.view-all', [
            'items' => $items
        ]);
    }

    public function toggleAddForm()
    {
        $this->isCreatingNewItem = !$this->isCreatingNewItem;
    }
}