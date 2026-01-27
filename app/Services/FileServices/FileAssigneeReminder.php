<?php 

namespace App\Services\FileServices;

use App\Models\File;

class FileAssigneeReminder {

    public static function sendNotification(): void
    {
        $files = File::where('start_date', '>', now())->where('status','pending')->get();
        info("Files reminder", [$files]);
    }
}