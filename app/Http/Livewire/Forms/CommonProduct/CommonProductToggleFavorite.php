<?php

namespace App\Http\Livewire\Forms\CommonProduct;

use Livewire\Component;

class CommonProductToggleFavorite extends Component
{
    public $isFavorite;
    public $commonProduct;

    public function mount()
    {
        $this->isFavorite = $this->commonProduct->favorite;
    }

    public function render()
    {
        return view('livewire.forms.common-product.common-product-toggle-favorite');
    }

    public function addFavorite()
    {
        $this->isFavorite = true;
        $this->saveCommonProduct();
    }

    public function removeFavorite()
    {
        $this->isFavorite = false;
        $this->saveCommonProduct();
    }

    public function saveCommonProduct()
    {
        $this->commonProduct->favorite = $this->isFavorite;
        $this->commonProduct->save();
        $this->emit('stockUpdated');
    }
}
