<?php

namespace App\Http\Livewire\Forms\Brand;

use App\Models\Brand;
use App\Rules\DifferentThanNonDefini;
use Livewire\Component;

class BrandEditForm extends Component
{
    public $show = false;
    public $brands;
    public $showDropdown = false;
    public $selectedBrand;
    public $newName;

    protected $rules = [
        'selectedBrand' => ['required'],
        'newName' => ['required', 'alpha_dash', 'unique:App\Models\Brand,name'],
    ];
    protected $messages = [
        'selectedBrand.required' => 'La marque à modifier doit être selectionnée',
        'newName.required' => 'Le nouveau nom de la marque séléctionnée doit être renseigné',
        'newName.alpha_dash' => 'Le nom de la marque ne doit contenir que des lettres, des chiffres',
        'newName.unique' => 'Le nom de la marque doit être unique',
    ];

    public function updated($property)
    {
        array_push($this->rules['selectedBrand'], new DifferentThanNonDefini());
        $this->validateOnly($property);
    }

    public function updateBrand()
    {
        array_push($this->rules['selectedBrand'], new DifferentThanNonDefini());
        $this->validate();
        $brand = Brand::find($this->selectedBrand);
        $oldName = $brand->name;
        $brand->update(['name' => $this->newName]);
        $this->toggleEditForm();
        return redirect('stock')->with('status', 'Le nom de la marque '.$oldName.' a bien été changé en '.$this->newName.' !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        $this->brands = Brand::all();
        return view('livewire.forms.brand.brand-edit-form');
    }
}
