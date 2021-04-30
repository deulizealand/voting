<?php

namespace App\Jobs;

use App\Mail\AttachEmailPresentasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailMassalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail, $subject, $fileEmail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail,$subject, $fileEmail)
    {
        $this->send_mail = $send_mail;
        $this->subject = $subject;
        $this->fileEmail = $fileEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new AttachEmailPresentasi($this->send_mail,$this->subject,$this->fileEmail);        
        Mail::to($this->send_mail)->send($email);
    }
}
