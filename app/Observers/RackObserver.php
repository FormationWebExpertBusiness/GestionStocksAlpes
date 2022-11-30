<?php

namespace App\Observers;

use App\Models\Rack;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class RackObserver
{
    /**
     * Handle the Rack "created" event.
     *
     * @param  \App\Models\Rack  $rack
     * @return void
     */
    public function created(Rack $rack)
    {
        for ($level=1; $level <= $rack->nb_level; $level++) { 
            $qrcode = QrCode::format('svg')->generate($rack->dataInQrcode($level));
            Storage::disk('local')->put('public/code-qr/rack-'.$rack->id.'_lvl-'.$level.'.svg', $qrcode);
        }
    }

    /**
     * Handle the Rack "updated" event.
     *
     * @param  \App\Models\Rack  $rack
     * @return void
     */
    public function updated(Rack $rack)
    {
        if ($rack->nb_level > $rack->getOriginal('nb_level')) {
            for ($level = $rack->getOriginal('nb_level'); $level <= $rack->nb_level; $level++) { 
                $qrcode = QrCode::format('svg')->generate($rack->dataInQrcode($level));
                Storage::disk('local')->put('public/code-qr/rack-'.$rack->id.'_lvl-'.$level.'.svg', $qrcode);
            }
        } else  if ($rack->nb_level < $rack->getOriginal('nb_level')) {
            for ($level = $rack->getOriginal('nb_level'); $level > $rack->nb_level; $level--) { 
                Storage::delete('public/code-qr/rack-'.$rack->id.'_lvl-'.$level.'.svg');
            }
        }
    }

    /**
     * Handle the Rack "deleted" event.
     *
     * @param  \App\Models\Rack  $rack
     * @return void
     */
    public function deleted(Rack $rack)
    {
        for ($level=1; $level <= $rack->nb_level; $level++) { 
            Storage::delete('public/code-qr/rack-'.$rack->id.'_lvl-'.$level.'.svg');
        }
    }

    /**
     * Handle the Rack "restored" event.
     *
     * @param  \App\Models\Rack  $rack
     * @return void
     */
    public function restored(Rack $rack)
    {
        //
    }

    /**
     * Handle the Rack "force deleted" event.
     *
     * @param  \App\Models\Rack  $rack
     * @return void
     */
    public function forceDeleted(Rack $rack)
    {
        //
    }
}
