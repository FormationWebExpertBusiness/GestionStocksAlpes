<?php

namespace App\Http\Livewire\Forms\Brand;

use App\Models\Brand;
use App\Models\CommonItem;
use Livewire\Component;

class BrandForm extends Component
{
    public $showDropdown = false;
    public $brands;
    public $warningDeleteItemSignal = 'deleteBrand';

    protected $listners = [
        'deleteBrand' => 'deleteBrand',
    ];

    public function openWarningDelete($brandId)
    {
        $brand = Brand::find($brandId);
        $deleteMessage = '';
        if (CommonItem::where('brand_id', $brandId)->count() > 0) {
            $deleteMessage = '⚠️ Des produits de la marque ' . $brand->name . 'existent dans le stock, si vous supprimez, les produits leur marque à "Non définie"';
        }
        $this->emit('deleteWarning', $brandId, $this->warningDeleteItemSignal, 'Brand', 'name', $deleteMessage);
    }

    public function deleteBrand($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        $brand->delete();
        return redirect()->with('status', 'La marque '.$brand->name.' a bien été supprimé !');
    }

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function mount()
    {
        $this->brands = Brand::where('id', '<>', 1)->get();
    }

    public function render()
    {
        return view('livewire.forms.brand.brand-form');
    }
}
