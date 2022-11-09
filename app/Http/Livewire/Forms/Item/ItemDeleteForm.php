<?php

namespace App\Http\Livewire\Forms\Item;

use App\Models\Item;
use Livewire\Component;

class ItemDeleteForm extends Component
{
    public $show = false;

    public $commonItem;
    public $items;
    public $itemsToDelete = [];

    protected $rules = [
        'itemsToDelete' => ['required'],
    ];
    protected $messages = [
        'itemsToDelete.required' => 'Un produit doit être selectionné pour supprimer',
    ];

    public function mount()
    {
        $this->resetInput();
    }

    public function deleteItem()
    {
        $noms = '';
        $this->validate();
        foreach ($this->itemsToDelete as $item_id) {
            $item = Item::find($item_id);
            $noms .= $item->serial_number . ', ';
            $item->delete();
        }
        substr($noms, 0, strlen($noms) - 2);

        $this->toggleDeleteForm();
        if (count($this->itemsToDelete) === 1) {
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
        $this->items = $this->commonItem->items;
    }

    public function render()
    {
        return view('livewire.forms.item.item-delete-form');
    }
}
