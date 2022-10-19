<?php

namespace App\Http\Livewire\Rack;

use App\Models\Rack;
use Livewire\Component;

class RackDeleteForm extends Component
{
    public $show = false;
    public $racks;
    public $showDropdown = false;
    public $selectedRack;

    public $warningDeleteRackSignal = 'deleteRack';

    protected $listeners = [
        'deleteRack' => 'deleteRack',
    ];

    protected $rules = [
        'selectedRack' => ['required'],
    ];

    protected $messages = [
        'selectedRack.required' => 'L\'étagère à supprimer dois être selectionnée',
    ];

    public function mount()
    {
        $this->selectedRack = null;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function toggleDeleteForm()
    {
        $this->show = ! $this->show;
    }

    public function openWarningDelete()
    {
        $validatedData = $this->validate();
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
        return view('livewire.rack.rack-delete-form');
    }
}
