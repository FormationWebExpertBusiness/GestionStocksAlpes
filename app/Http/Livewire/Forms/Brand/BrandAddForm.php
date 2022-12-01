<?php

namespace App\Http\Livewire\Forms\Brand;

use App\Models\Brand;
use Livewire\Component;

class BrandAddForm extends Component
{
    public $name;
    public $show = false;

    protected $rules = [
        'name' => ['required', 'alpha_dash', 'unique:App\Models\Brand,name'],
    ];
    protected $messages = [
        'name.required' => 'Le nom dois être renseigné',
        'name.alpha_dash' => 'Le nom de la marque ne doit contenir que des lettres, des chiffres',
        'name.unique' => 'Le nom de la marque doit être unique',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function saveBrand()
    {
        $this->validate();
        Brand::create([
            'name' => $this->name,
        ]);
        $this->toggleAddForm();
        return redirect('/configuration/brand')->with('status', 'La marque '. $this->name .' a bien été ajouté !');
    }

    public function toggleAddForm()
    {
        $this->show = ! $this->show;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.forms.brand.brand-add-form');
    }
}
