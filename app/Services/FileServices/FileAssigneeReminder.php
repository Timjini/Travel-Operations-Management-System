<?php 

namespace App\Services\FileServices;

use App\Mail\FileAssigneeReminderMail;
use App\Models\File;
use App\Services\Mailers\MailerInterface;
class FileAssigneeReminder {

    public function __construct(private MailerInterface $mailer) {}

    public function sendNotification(): void
    {
        $files = File::where('start_date', '>', now())->where('status','pending')->get();
        try {
            foreach ($files as $file) {
                foreach ($file->assignees as $assignee) {
                    if (empty($assignee->email)) {
                        continue; 
                    }
                    $this->mailer->send($assignee->email, new FileAssigneeReminderMail($file));
                }
            }
            info("file reminder emails sent");
        } catch (\Exception $e) {
            info("issue sending emails", ['error' => $e->getMessage()]);
        }
    }
}
