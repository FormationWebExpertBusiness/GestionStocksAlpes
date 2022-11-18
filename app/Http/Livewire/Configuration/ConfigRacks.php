<?php

namespace App\Http\Livewire\Configuration;

use App\Models\CommonItem;
use App\Models\Rack;
use Livewire\Component;

class ConfigRacks extends Component
{
    public $showDropdown = false;
    public $racks;
    public $warningDeleteItemSignal = 'deleteRack';
    
    public $showToast = false;

    protected $listners = [
        'deleteRack' => 'deleteRack',
    ];

    public function openWarningDelete($rackId)
    {
        $rack = Rack::find($rackId);
        $deleteMessage = '';
        if ($rack->itemsOn()->count() > 0) {
            $deleteMessage = '⚠️ ' . $rack->name . ' n\'est pas vide, la suppresion est impossible';
        }
        $this->emit('deleteWarning', $rackId, $this->warningDeleteItemSignal, 'Rack', 'name', $deleteMessage, $rack->itemsOn()->count() <= 0);
    }

    public function deleteRack($rackId)
    {
        $rack = Rack::findOrFail($rackId);
        $rack->delete();
        return redirect()->with('status', 'La marque '.$rack->name.' a bien été supprimé !');
    }

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function mount()
    {
        $this->racks = Rack::all();
    }

    public function render()
    {
        return view('livewire.configuration.config-racks')->layout('layout');
    }
}
