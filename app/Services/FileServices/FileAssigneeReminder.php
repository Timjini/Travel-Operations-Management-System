<?php 

namespace App\Services\FileServices;

use App\Mail\FileAssigneeReminderMail;
use App\Models\Assignee;
use App\Models\File;
use App\Services\Mailers\MailerInterface;
class FileAssigneeReminder {

    public function __construct(private MailerInterface $mailer) {}

    public function sendNotification(): void
    {
        info("sending Notification");
        $files = File::where('start_date', '>', now())->where('status','pending')->get();
        
        info("found files ", [$files]);
        try {
            foreach ($files as $file) {
                foreach ($file->assignees as $assignee) {
                    $assigneeEmail = Assignee::find($assignee->assignee_id)->email;
                    info("assigneeEmail", [$assigneeEmail]);
                    if (empty($assigneeEmail)) {
                        continue; 
                    }
                    info("sending email---->");
                    $this->mailer->send($assigneeEmail, new FileAssigneeReminderMail($file));
                }
            }
            info("file reminder emails sent");
        } catch (\Exception $e) {
            info("issue sending emails", ['error' => $e->getMessage()]);
        }
    }
}
