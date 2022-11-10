<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
// use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

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
            Log::debug("Queue::after AppServiceProvider");
            // return Storage::download('testBonjour.csv');
            // return response()->download($filename)->deleteFileAfterSend(true);
        });
    }
}
