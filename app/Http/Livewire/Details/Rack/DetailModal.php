<?php

namespace App\Http\Livewire\Details\Rack;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Livewire\Component;

class DetailModal extends Component
{
    public $show = false;
    public $rack;

    public function toggleModal()
    {
        $this->show = ! $this->show;
    }

    public function downloadQrcode($level)
    {
        $data = [
            'rack' => $this->rack,
            'level' => $level,
        ];
        $customPaper = [0, 0, 220, 280];

        $pdf = FacadePdf::loadView('livewire.qrcode.pdf', $data)->setPaper($customPaper, 'portrait')->output();
        return response()->streamDownload(
            fn () => print $pdf,
            'qrcode_etagere.pdf'
        );
    }

    public function render()
    {
        return view('livewire.details.rack.detail-modal');
    }
}
