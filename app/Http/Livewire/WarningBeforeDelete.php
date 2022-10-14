<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WarningBeforeDelete extends Component
{
    public $isOpen;
    public $deleteEmit;
    public $tId;
    public $name;

    protected $listeners = [
        'deleteWarning' => 'openModal'
    ];

    // $this->emit('deleteWarning', $itemId, $this->warningDeleteItemSignal, 'Item', 'model');

    public function openModal($tId, $emitSignal, $type, $champ)
    {
        $this->isOpen = true;
        $this->tId = $tId;
        $this->deleteEmit = $emitSignal;
        $useClass = "App\Models\\".$type;
        $this->name = $useClass::find($tId)->$champ;
        $obj = $useClass::find($tId);
        $champ;
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
