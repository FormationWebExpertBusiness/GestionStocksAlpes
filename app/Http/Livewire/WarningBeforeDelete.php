<?php

namespace App\Http\Livewire;

use Livewire\Component;

// TO trigger this component you need to emit the event 'deleteWarning' with the following parameters:
// $this->emit('deleteWarning', $id, $this->emitSignal, typeofElementToDelete, attributeToDisplayWhenDeleting);
// $id: the id of the element to delete
// $this->emitSignal: the signal to emit when the user confirm the deletion (you will receive it in the your listener)
// typeofElementToDelete: the type of the element to delete (ex: 'Category')
// attributeToDisplayWhenDeleting: the attribute of the element to display when deleting (ex: 'name')

class WarningBeforeDelete extends Component
{
    public $isOpen;
    public $deleteEmit;
    public $tId;
    public $name;
    public $message;
    public $isAllowingDeletion;

    protected $listeners = [
        'deleteWarning' => 'openModal',
    ];

    // $this->emit('deleteWarning', $productId, $this->warningDeleteProductSignal, 'Product', 'model');

    public function openModal($tId, $emitSignal, $type, $champ, $message = '', $isAllowingDeletion = true)
    {
        $this->isOpen = true;
        $this->tId = $tId;
        $this->deleteEmit = $emitSignal;
        $useClass = "App\Models\\".$type;
        $this->name = $useClass::find($tId)->$champ;
        $this->message = $message;
        $this->isAllowingDeletion = $isAllowingDeletion;
    }

    public function delete()
    {
        $this->emit($this->deleteEmit, $this->tId);
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.warning-before-delete');
    }
}
