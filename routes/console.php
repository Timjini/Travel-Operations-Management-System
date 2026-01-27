<?php

use App\Services\FileServices\FileAssigneeReminder;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function (FileAssigneeReminder $reminder) {
    $reminder->sendNotification();
})->everyFiveSeconds();

// send reminder manually
Artisan::command('reminders:send-files', function (FileAssigneeReminder $reminder) {
    $reminder->sendNotification();
    $this->info('Reminders sent successfully!');
});