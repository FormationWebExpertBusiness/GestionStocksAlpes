<?php

namespace App\Http\Livewire;

use App\Models\CommonItem;
use Livewire\Component;

class Dashboard extends Component
{

    public $items;

    public function render()
    {
        $this->items = CommonItem::limit(10)->orderBy('id', 'DESC')->get();

        return view('livewire.dashboard')->layout('layout') ;
    }
}
