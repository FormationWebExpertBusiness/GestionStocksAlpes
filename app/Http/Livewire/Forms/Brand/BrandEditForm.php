<?php

namespace App\Http\Livewire\Forms\Brand;

use Livewire\Component;

class BrandEditForm extends Component
{
    public $show = false;
    public $brand;
    public $newName;

    protected $rules = [
        'newName' => ['required', 'alpha_dash', 'unique:App\Models\Brand,name'],
    ];
    protected $messages = [
        'newName.required' => 'Le nouveau nom de la marque séléctionnée doit être renseigné',
        'newName.alpha_dash' => 'Le nom de la marque ne doit contenir que des lettres, des chiffres',
        'newName.unique' => 'Le nom de la marque doit être unique',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateBrand()
    {
        $this->validate();
        $oldName = $this->brand->name;
        $this->brand->update(['name' => $this->newName]);
        $this->toggleEditForm();
        return redirect('/configuration/brand')->with('status', 'Le nom de la marque '.$oldName.' a bien été changé en '.$this->newName.' !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
        $this->newName = '';
    }

    public function render()
    {
        return view('livewire.forms.brand.brand-edit-form');
    }
}
