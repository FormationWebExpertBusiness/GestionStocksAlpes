<?php

namespace App\Http\Livewire\Forms\CommonItem;

use Livewire\Component;

class CommonItemToggleFavorite extends Component
{
    public $isFavorite;
    public $commonItem;

    public function mount()
    {
        $this->isFavorite = $this->commonItem->favorite;
    }

    public function render()
    {
        return view('livewire.forms.common-item.common-item-toggle-favorite');
    }

    public function addFavorite()
    {
        $this->isFavorite = true;
        $this->saveCommonItem();
    }

    public function removeFavorite()
    {
        $this->isFavorite = false;
        $this->saveCommonItem();
    }

    public function saveCommonItem()
    {
        $this->commonItem->favorite = $this->isFavorite;
        $this->commonItem->save();
        $this->emit('stockUpdated');
    }
}
