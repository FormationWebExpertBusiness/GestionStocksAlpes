<?php

namespace App\Http\Livewire\Forms\Brand;

use Livewire\Component;
use App\Models\Brand;

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
        if ($this->selectedBrand !== null) {
            $brand = Brand::where('name', $this->selectedBrand);
            $this->emit('deleteWarning', $brand->first()->id, $this->warningDeleteBrandSignal, 'Brand', 'name');
        }
    }

    public function deleteBrand($brandId)
    {
        Brand::find($brandId)->delete();
        $this->toggleDeleteForm();
        return redirect('stock')->with('status', 'La brand '.$this->selectedBrand.' a bien été supprimé !');
    }

    public function render()
    {
        $this->brands = Brand::all();
        return view('livewire.forms.brand.brand-delete-form');
    }
}
