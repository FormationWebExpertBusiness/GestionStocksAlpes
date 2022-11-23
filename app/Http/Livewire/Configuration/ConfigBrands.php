<?php

namespace App\Http\Livewire\Configuration;

use App\Models\Brand;
use App\Models\CommonItem;
use Livewire\Component;

class ConfigBrands extends Component
{
    public $brands;
    public $warningDeleteItemSignal = 'deleteBrand';

    public $showToast = true;

    protected $listeners = [
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
    
    public function render()
    {
        $this->brands = Brand::where('id', '<>', 1)->get();
        return view('livewire.configuration.config-brands')->layout('layout');
    }
}
