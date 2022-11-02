<?php

namespace App\Http\Livewire\Forms\Brand;

use App\Models\Brand;
use Livewire\Component;

class BrandDeleteForm extends Component
{
    public $show = false;
    public $brands;
    public $showDropdown = false;
    public $selectedBrand;

    public $warningDeleteBrandSignal = 'deleteBrand';

    protected $listeners = [
        'deleteBrand' => 'deleteBrand',
    ];

    protected $rules = [
        'selectedBrand' => ['required'],
    ];

    protected $messages = [
        'selectedBrand.required' => 'La marque à supprimer dois être selectionnée',
    ];

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function updated($property)
    {
        if ($this->$property === 'Non défini') {
            $this->$property = null;
        }
        $this->validateOnly($property);
    }

    public function toggleDeleteForm()
    {
        $this->show = ! $this->show;
    }

    public function openWarningDelete()
    {
        $validatedData = $this->validate();
        $brand = Brand::where('name', $this->selectedBrand);
        $this->emit('deleteWarning', $brand->first()->id, $this->warningDeleteBrandSignal, 'Brand', 'name');
    }

    public function deleteBrand($brandId)
    {
        Brand::find($brandId)->delete();
        $this->toggleDeleteForm();
        return redirect('stock')->with('status', 'La marque '.$this->selectedBrand.' a bien été supprimé !');
    }

    public function render()
    {
        $this->brands = Brand::all();
        return view('livewire.forms.brand.brand-delete-form');
    }
}
