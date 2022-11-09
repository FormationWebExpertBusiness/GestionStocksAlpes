<?php

namespace App\Http\Livewire;

use App\Models\HistoryItem;
use Livewire\Component;

class History extends Component
{
    public $historyItems;

    public function render()
    {
        $this->historyItems = HistoryItem::all()->sortByDesc('created_at');
        return view('livewire.history')->layout('layout');
    }
}
