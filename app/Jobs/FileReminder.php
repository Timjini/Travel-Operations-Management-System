<?php

namespace App\Jobs;

use App\Models\File;
use App\Services\FileServices\FileAssigneeReminder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FileReminder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public File $file,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(FileAssigneeReminder $processor): void
    {
        info("Processor running", ['processor' => $processor]);
    }
}
