<?php

namespace App\Http\Livewire\Forms\Product;

use App\Models\Product;
use Livewire\Component;

class ProductDeleteForm extends Component
{
    public $show = false;

    public $commonProduct;
    public $products;
    public $productsToDelete = [];

    protected $rules = [
        'productsToDelete' => ['required'],
    ];
    protected $messages = [
        'productsToDelete.required' => 'Un produit doit être selectionné pour supprimer',
    ];

    public function mount()
    {
        $this->resetInput();
    }

    public function deleteProduct()
    {
        $noms = '';
        $this->validate();
        foreach ($this->productsToDelete as $product_id) {
            $product = Product::find($product_id);
            $noms .= $product->serial_number . ', ';
            $product->delete();
        }
        substr($noms, 0, strlen($noms) - 2);

        $this->toggleDeleteForm();
        if (count($this->productsToDelete) === 1) {
            return redirect('stock')->with('status', 'Le produit '.$noms.' a bien été retiré du stock !');
        }
        return redirect('stock')->with('status', 'Les produits '.$noms.' ont bien étés retirés du stock !');
    }

    public function toggleDeleteForm()
    {
        $this->show = ! $this->show;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->products = $this->commonProduct->products;
    }

    public function render()
    {
        return view('livewire.forms.product.product-delete-form');
    }
}
