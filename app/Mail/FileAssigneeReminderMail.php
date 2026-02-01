<?php

namespace App\Mail;

use App\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FileAssigneeReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public File $file,
    )
    {
        $this->file = $file;
    }

    public function build()
    {

        return $this->subject('File #' . $this->file->reference)
            ->view('emails.reminders.file-assignee')
            ->with([
                'file' => $this->file,
            ]);
    }
}
