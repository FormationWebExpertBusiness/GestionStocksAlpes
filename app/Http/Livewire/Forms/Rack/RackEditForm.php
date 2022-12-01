<?php

namespace App\Http\Livewire\Forms\Rack;

use App\Rules\NotEmptyRackLevel;
use Livewire\Component;

class RackEditForm extends Component
{
    public $show = false;
    public $nb_level;
    public $name;
    public $rack;

    protected $rules = [
        'name' => ['nullable', 'unique:racks,name'],
        'nb_level' => ['min:1', 'numeric', 'required'],
    ];
    protected $messages = [
        'nb_level.min' => 'Il doit y avoir au moins un étage',
        'nb_level.required' => 'Le nombre d\'étage dois être renseigné',
    ];

    public function mount()
    {
        $this->nb_level = $this->rack->nb_level;
        $this->name = $this->rack->name;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateRack()
    {
        array_push($this->rules['nb_level'], new NotEmptyRackLevel());
        $validatedData = $this->validate();
        $oldNbLevel = $this->rack->nb_level;
        $this->rack->update($validatedData);
        $this->toggleEditForm();
        return redirect('/configuration/rack')->with('status', $this->rack->name.' est passé de '.$oldNbLevel.' à '.$this->rack->nb_level.' étage(s) !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
        $this->nb_level = $this->rack->nb_level;
        $this->name = $this->rack->name;
    }

    public function render()
    {
        return view('livewire.forms.rack.rack-edit-form');
    }
}
