<?php

namespace App\Listeners;

use App\Events\EndedCommonItemCsvExport;
use Illuminate\Support\Facades\Log;

class EndedCommonItemCsvExportListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    // /**
    //  * Register the listeners for the subscriber.
    //  *
    //  * @param  \Illuminate\Events\Dispatcher  $events
    //  * @return void
    //  */
    // public function subscribe($events)
    // {
    //     $events->listen(
    //         [EndedCommonItemCsvExport::class, 'handle']
    //     );
    // }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EndedCommonItemCsvExport  $event
     *
     * @return void
     */
    public function handle(EndedCommonItemCsvExport $event)
    {
        // 
    }
}
