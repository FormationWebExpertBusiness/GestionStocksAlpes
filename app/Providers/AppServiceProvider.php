<?php

namespace App\Providers;

use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
// use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Queue::before(function (JobProcessing $event) {
        //     // $event->connectionName
        //     // $event->job
        //     // $event->job->payload()
        //     dd($event->job->payload());
        // });

        Queue::after(function (JobProcessed $event) {
            // Log::debug("gbvcds");
            // $filename = '../storage/app/testBonjour.csv';
            Log::debug('Queue::after AppServiceProvider');
            // return Storage::download('testBonjour.csv');
            // return response()->download($filename)->deleteFileAfterSend(true);
        });
    }
}
