<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class varify_user extends Mailable
{
    use Queueable, SerializesModels;

    private $username = '';
    private $domain = '';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$domain)
    {
        //
        $this->username = $username;
        $this->domain = $domain;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
       

        return new Envelope(
            from: new Address('admin@gmail.com', 'opad'),
            subject: 'Varify User',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $link = $this->domain . '/varify_user?username='. $this->username;

        return new Content(
            view: 'email.varify_user',
            with: [
                'link' => $link,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
