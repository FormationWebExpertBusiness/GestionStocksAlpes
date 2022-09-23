<?php
 
namespace App\Http\Livewire;
 
use Livewire\Component;
 
class DetailModal extends Component
{
    public $show = false;
    public $category;
    public $price;
    public $brand;
    public $model;
    public $quantity;
    public $comment;
    public $unit;
    public $currency;
 
    public function toggleModal()
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.detail-modal', [
            'show' => $this->show,
            'category' => $this->category,
            'price' => $this->price,
            'brand' => $this->brand,
            'model' => $this->model,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'currency' => $this->currency,
            'comment' => $this->comment
        ]);
    }
}
