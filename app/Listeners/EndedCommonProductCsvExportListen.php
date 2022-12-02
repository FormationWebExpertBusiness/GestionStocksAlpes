<?php

namespace App\Listeners;

use App\Events\EndedCommonProductCsvExport;

class EndedCommonProductCsvExportListen
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
    //         [EndedCommonProductCsvExport::class, 'handle']
    //     );
    // }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EndedCommonProductCsvExport  $event
     *
     * @return void
     */
    public function handle(EndedCommonProductCsvExport $event)
    {
    }
}
