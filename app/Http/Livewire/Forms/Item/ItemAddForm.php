<?php

namespace App\Http\Livewire\Forms\Item;

use App\Models\Item;
use App\Models\Rack;
use Livewire\Component;

class ItemAddForm extends Component
{
    public $show = false;

    public $racks;

    public $serial_number;
    public $price;
    public $comment;
    public $rack_id;
    public $rack_level;
    public $common_id;

    protected $rules = [
        'common_id' => ['required'],
        'serial_number' => ['required', 'alpha_num'],
        'price' => ['required', 'numeric'],
        'comment' => ['nullable'],
        'rack_id' => ['required', 'integer'],
        'rack_level' => ['required', 'integer', 'min:1'],
    ];
    protected $messages = [
        'serial_number.required' => 'Le numéro de série dois être renseigné',
        'serial_number.alpha_num' => 'Le numéro de série ne peut contenir que des chiffres et des lettres',
        'price.required' => 'La valeur du stock doit être ajouté.',
        'price.numeric' => 'Le prix doit être un nombre',
        'rack_id.integer' => 'L\'élément saisi est incorrect',
        'rack_id.required' => 'L\'emplacement de stockage doit être saisi',
        'rack_level.interger' => 'le niveau de l\'étagère doit être saisie',
        'rack_level.required' => 'L\'emplacement de stockage doit être saisi',
    ];

    public function mount()
    {
        $this->resetInput();
    }

    public function updated($property)
    {
        $this->validateOnly($property);

        if ($property = 'rack_id' && $this->rack_level > $this->getSelectedRack()?->nb_level) {
            $this->rack_level = null;
        }
    }

    public function saveItem()
    {
        $nom = $this->serial_number;
        $validatedData = $this->validate();
        Item::create($validatedData);
        $this->toggleAddForm();
        return redirect('stock')->with('status', 'Le produit '.$nom.' a bien été ajouté !');
    }

    public function toggleAddForm()
    {
        $this->show = ! $this->show;
        $this->resetInput();
    }

    public function getSelectedRack()
    {
        return Rack::find($this->rack_id);
    }
    
    public function resetInput()
    {
        $this->serial_number = null;
        $this->price = null;
        $this->comment = null;
        $this->rack_id = null;
        $this->rack_level = null;

        $this->racks = Rack::all();
    }

    public function render()
    {
        return view('livewire.forms.item.item-add-form');
    }
}
