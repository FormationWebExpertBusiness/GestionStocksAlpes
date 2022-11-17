<?php

namespace App\Jobs;

use App\Events\EndedCommonItemCsvExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $csvExportId;

    public function __construct($csvExportId)
    {
        $this->csvExportId = $csvExportId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        event(new EndedCommonItemCsvExport($this->csvExportId));
    }
}
