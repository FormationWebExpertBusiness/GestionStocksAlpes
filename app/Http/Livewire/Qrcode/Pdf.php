<?php

namespace App\Http\Livewire\Qrcode;

use Livewire\Component;

class Pdf extends Component
{
    public $qrcode_link;

    public function render()
    {
        return view('livewire.qrcode.pdf');
    }
}
