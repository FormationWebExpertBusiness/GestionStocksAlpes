<?php

namespace App\Http\Livewire\Details\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

class DetailModal extends Component
{
    use WithFileUploads;

    public $show = false;
    public $commonProduct;
    public $photo_product;
    public $rack;
    public $rack_level;

    public $warningDeleteProductSignal = 'deleteProduct';

    protected $listeners = [
        'racksFilter' => 'getRack',
        'rackLevelsFilter' => 'getRackLevel',
    ];

    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.details.product.detail-modal');
    }

    public function openWarningDelete($productId)
    {
        $this->emit('deleteWarning', $productId, $this->warningDeleteProductSignal, 'Product', 'serial_number');
    }

    public function getRack($rack)
    {
        $this->rack = $rack;
    }

    public function getRackLevel($rackLevel)
    {
        $this->rack_level = $rackLevel;
    }
}
