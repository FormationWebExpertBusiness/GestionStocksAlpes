<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;

    private $products;
    public $readyToLoad = false;
    public $showToast = true;

    public $warningDeleteProductSignal = 'deleteProduct';

    public function openWarningDelete($productId)
    {
        $this->emit('deleteWarning', $productId, $this->warningDeleteProductSignal, 'Product', 'serial_number');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Le produit '.$product->serial_number.' a bien été supprimé !']);
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function closeToast()
    {
        $this->showToast = false;
    }

    public function collectionToPaginator()
    {
        $perPage = 20;

        $productsOnPage = $this->products->forPage($this->page, $perPage);

        return new LengthAwarePaginator($productsOnPage, $this->products->count(), $perPage, $this->page);
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->products = Product::all();
        } else {
            $this->products = collect();
        }
        $paginatedProducts = $this->collectionToPaginator();
        return view('livewire.inventory', ['products' => $paginatedProducts])->layout('layout');
    }

    protected function getListeners()
    {
        return [
            'deleteProduct' => 'deleteProduct',
        ];
    }
}
