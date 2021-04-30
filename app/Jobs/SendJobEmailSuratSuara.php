<?php

namespace App\Jobs;

use App\Mail\VotingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendJobEmailSuratSuara implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail, $subject,$body;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail,$subject,$body)
    {
        $this->send_mail = $send_mail;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new VotingMail($this->send_mail,$this->subject,$this->body);        
        Mail::to($this->send_mail)->send($email);
    }
}
