<?php

namespace App\Http\Livewire\Forms\CommonProduct;

use App\Models\CommonProduct;
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
        if (CommonProduct::totalFavoriteProduct() < 20) {//limit to 20 Product in favorite
            $this->isFavorite = true;
            $this->saveCommonProduct();
            if(CommonProduct::totalFavoriteProduct() == 20){
                $this->dispatchBrowserEvent('alert', ['type' => 'info',  'message' => 'La limite de 20 favoris vient d\'être atteinte']);    
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Il ne peut pas y avoir plus de 20 produit en favoris']);
        }
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
