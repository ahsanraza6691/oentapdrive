<?php

namespace App\Jobs;

use Mail;
use App\Mail\StandardEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $from, string $from_name, string $subject, string $view, string $type, array $extra, array $attachment = [])
    {
        $this->details['from']          = $from;
        $this->details['from_name']     = $from_name;
        $this->details['subject']       = $subject;
        $this->details['view']          = $view;
        $this->details['type']          = $type;
        $this->details['extra']         = $extra;
        $this->details['attachment']    = $attachment;
        $this->details['extra']['bcc'] = config('constants.MAIL_BCC');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->details['extra']['send_to'])->send(new StandardEmail($this->details));
    }
}
