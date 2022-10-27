<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class Dashboard extends Component
{

    public $items;

    public function render()
    {

        $this->items = Item::limit(10)->orderBy('id', 'DESC')->get();

        return view('livewire.dashboard')->layout('layout') ;
    }
}
