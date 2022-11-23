<?php

namespace App\Http\Livewire\Forms\Rack;

use App\Models\Rack;
use Livewire\Component;

class RackAddForm extends Component
{
    public $nb_level;
    public $show = false;

    protected $rules = [
        'nb_level' => ['min:1', 'numeric', 'required'],
    ];
    protected $messages = [
        'nb_level.required' => 'Le nombre d\'étage dois être renseigné',
        'nb_level.min' => 'Il doit y avoir au moins un étage',
    ];

    public function mount()
    {
        $this->nb_level = 1;
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function saveRack()
    {
        $validatedData = $this->validate();
        $rack = Rack::create($validatedData);
        $this->toggleAddForm();
        return redirect('/configuration/rack')->with('status', 'L\'étagère '.$rack->id.' a bien été ajouté avec '.$rack->nb_level .' étage(s) !');
    }

    public function toggleAddForm()
    {
        $this->show = ! $this->show;
        $this->nb_level = 0;
    }

    public function render()
    {
        return view('livewire.forms.rack.rack-add-form');
    }
}
