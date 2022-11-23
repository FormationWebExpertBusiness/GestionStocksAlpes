<?php

namespace App\Http\Livewire\Forms\Rack;

use App\Models\Rack;
use App\Rules\NotEmptyRack;
use Livewire\Component;

class RackDeleteForm extends Component
{
    public $show = false;
    public $rack;

    public $warningDeleteRackSignal = 'deleteRack';

    protected $listeners = [
        'deleteRack' => 'deleteRack',
    ];

    public function toggleDeleteForm()
    {
        $this->show = ! $this->show;
    }

    public function openWarningDelete()
    {
        array_push($this->rules['selectedRack'], new NotEmptyRack());
        $this->validate();
        $rack = Rack::find($this->selectedRack);
        $this->emit('deleteWarning', $rack->id, $this->warningDeleteRackSignal, 'Rack', 'name');
    }

    public function deleteRack($rackId)
    {
        Rack::find($rackId)->delete();
        $this->toggleDeleteForm();
        return redirect('stock')->with('status', 'L\'étagère '.$rackId.' a bien été supprimée !');
    }

    public function render()
    {
        $this->racks = Rack::all();
        return view('livewire.forms.rack.rack-delete-form');
    }
}
