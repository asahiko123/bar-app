<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $verifyRoute = 'verify';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Bottoms up!のご登録メール';

        $baseUrl = config('app.url');
        $token = $this->token;
        $url = "{$baseUrl}/{$this->verifyRoute}/{$token}";

        $from = config('mail.from.adress');


        return $this->from($from)
                    ->subject($subject)
                    ->view('mails.verfication_mail')
                    ->with('url',$url);
    }
}
