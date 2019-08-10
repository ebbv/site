<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(now()->isoFormat('LLL').' - EBBV Formulaire de Contact')
            ->view('emails.contactForm')
            ->with([
                'sender'=> request()->email,
                'body'  => request()->body
            ]);
    }
}
