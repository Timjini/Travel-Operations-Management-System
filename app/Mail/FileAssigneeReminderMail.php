<?php
namespace App\Mail;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileAssigneeReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public File $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function build()
    {
        return $this->subject('File')
            ->view('emails.reminders.file-assignee')
            ->with([
                'file' => $this->file,
            ]);
    }
}


