<?php

namespace App\Http\Livewire\Forms\Rack;

use App\Models\Rack;
use App\Rules\NotEmptyRackLevel;
use Livewire\Component;

class RackEditForm extends Component
{
    public $show = false;
    public $nb_level;
    public $rack;

    protected $rules = [
        'nb_level' => ['min:1', 'numeric', 'required'],
    ];
    protected $messages = [
        'nb_level.min' => 'Il doit y avoir au moins un étage',
        'nb_level.required' => 'Le nombre d\'étage dois être renseigné',
    ];

    public function mount()
    {
        $this->nb_level = 1;
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
        return redirect('/configuration/rack')->with('status', 'L\'étagère '.$this->rack->id.' est passé de '.$oldNbLevel.' à '.$this->rack->nb_level.' étage(s) !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.forms.rack.rack-edit-form');
    }
}
