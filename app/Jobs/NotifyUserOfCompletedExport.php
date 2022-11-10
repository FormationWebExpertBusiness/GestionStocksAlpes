<?php

namespace App\Jobs;

use App\Events\EndedCommonItemCsvExport;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Queue\SerializesModels;
use App\Http\Livewire\ViewAll;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct()
    {
        // $this->handle();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug("Firing EndedCommonItemCsvExport event");
        event(new EndedCommonItemCsvExport);
    }
}
