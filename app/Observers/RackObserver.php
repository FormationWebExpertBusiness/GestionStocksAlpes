<?php

namespace App\Observers;

use App\Models\Rack;

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
        if (!$rack->name) {
            $rack->name = 'Étagère '.$rack->id;
            $rack->save();
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
        if (!$rack->name) {
            $rack->name = 'Étagère '.$rack->id;
            $rack->save();
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
        //
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
