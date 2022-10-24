<?php

namespace App\Http\Livewire\Forms\Rack;

use App\Models\Rack;
use Livewire\Component;

class RackEditForm extends Component
{
    public $show = false;
    public $racks;
    public $showDropdown = false;
    public $selectedRack;
    public $nb_level;

    protected $rules = [
        'selectedRack' => ['required'],
        'nb_level' => ['required', 'min:1'],
    ];
    protected $messages = [
        'selectedRack.required' => 'L\'étagère à modifier doit être selectionnée',
        'nb_level.required' => 'Le nombre d\'étage dois être renseigné',
        'nb_level.min' => 'Il doit y avoir au moins un étage',
    ];

    public function mount()
    {
        $this->selectedRack = "";
        $this->nb_level = 1;
    }

    public function updated($property)
    {
        if($this->$property === "---") $this->$property = null;
        $this->validateOnly($property);
    }

    public function updateRack()
    {
        $validatedData = $this->validate();
        $rack = Rack::find($this->selectedRack);
        $rack->update($validatedData);
        $this->toggleEditForm();
        return redirect('stock')->with('status', 'L\'étagère '.$rack->id.' a désormais '.$rack->nb_level.'étage(s) !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        $this->racks = Rack::all();
        return view('livewire.forms.rack.rack-edit-form');
    }
}