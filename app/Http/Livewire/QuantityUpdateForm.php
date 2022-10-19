<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QuantityUpdateForm extends Component
{
    public $itemToUpdate;
    public $quantityIncrease;
    public $priceIncrease;
    public $quantityDecrease;

    public $isFormOpen = false;

    public $rulesIncrease = [
        'quantityIncrease' => ['required', 'numeric', 'min:1'],
        'priceIncrease' => ['required', 'numeric', 'min:0'],
    ];

    public $rulesDecrease = [
        'quantityDecrease' => ['required', 'numeric', 'min:1'],
    ];

    protected $messages = [
        'quantityIncrease.numeric' => 'la quantité doit être un nombre',
        'quantityIncrease.min' => 'la quantité doit être de minimum 1',
        'quantityIncrease.required' => 'la quantité à ajouter en stock doit être saisi.',
        'priceIncrease.numeric' => 'le prix doit être un nombre',
        'priceIncrease.min' => 'le prix doit être de minimum 0',
        'priceIncrease.required' => 'la quantité en stock doit être saisie.',
        'quantityDecrease.numeric' => 'la quantité doit être un nombre',
        'quantityDecrease.min' => 'la quantité doit être de minimum 1',
        'quantityDecrease.max' => 'la quantité ne peut pas être supérieur à la quantité en stock',
        'quantityDecrease.required' => 'la quantité à retirer du stock doit être saisi.',
    ];
    public function mount()
    {
        array_push($this->rulesDecrease['quantityDecrease'], 'max:'.$this->itemToUpdate->quantity);
    }

    public function render()
    {
        return view('livewire.quantity-update-form');
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'quantityDecrease') {
            $this->validateOnly($propertyName, $this->rulesDecrease);
        } else {
            $this->validateOnly($propertyName, $this->rulesIncrease);
        }
    }

    public function increaseItem()
    {
        $validatedData = $this->validate($this->rulesIncrease);
        $oldQuantity = $this->itemToUpdate->quantity;
        $newQuantity = $oldQuantity + $validatedData['quantityIncrease'];

        $this->itemToUpdate->quantity += $validatedData['quantityIncrease'];
        $this->itemToUpdate->price += $validatedData['priceIncrease'];
        $this->itemToUpdate->save();

        $this->closeForm();
        return redirect('stock')->with('status', 'La quantité de l\'objet '.$this->itemToUpdate->model.' est bien passé de '.$oldQuantity.' à '.$newQuantity.' !');
    }

    public function decreaseItem()
    {
        $validatedData = $this->validate($this->rulesDecrease);
        $oldQuantity = $this->itemToUpdate->quantity;
        $newQuantity = $oldQuantity - $validatedData['quantityDecrease'];

        $this->itemToUpdate->price -= $this->itemToUpdate->price / $this->itemToUpdate->quantity * $validatedData['quantityDecrease'];
        $this->itemToUpdate->quantity -= $validatedData['quantityDecrease'];
        $this->itemToUpdate->save();

        $this->closeForm();
        return redirect('stock')->with('status', 'La quantité de l\'objet '.$this->itemToUpdate->model.' est bien passé de '.$oldQuantity.' à '.$newQuantity.' !');
    }

    public function closeForm()
    {
        $this->quantityIncrease = null;
        $this->priceIncrease = null;
        $this->quantityDecrease = null;

        $this->isFormOpen = false;

        $this->emit('stockUpdated');
    }
}
