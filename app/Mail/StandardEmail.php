<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StandardEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        
        $this->details = $details;
    }

    public function build()
    {
        extract($this->details);
        $sender = $this->view('emails-template.'.$view) 
                        ->replyTo($from, $from_name)
                        ->subject($subject)
                        ->with([
                            'extra' => $extra,
                            'type'  => $type,
                            'OTP_CODE' => 'sssss'
                        ]);

        if (isset($extra['bcc']) && $extra['bcc']) {
            foreach( $extra['bcc'] as $bcc){
                $sender->bcc($bcc);
            }
           
        }

        if( !empty($attachment) ){
            foreach($attachment as $file){
                $sender->attach($file);
            }
        }

        return $sender;
    }
}
