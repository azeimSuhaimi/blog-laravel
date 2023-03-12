<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

class subscriber extends Mailable
{
    use Queueable, SerializesModels;

    
    private $email = '';
    private $admin = '';
    private $domain = '';
    private $content = '';

    /**
     * Create a new message instance.
     */
    public function __construct($email, $admin,$domain, $content)
    {
                //
                $this->email = $email;
                $this->admin = $admin;
                $this->domain = $domain;
                $this->content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->admin, 'opad'),
            subject: 'Subscriber notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $unsubscribe = $this->domain . '/unsubscribe?email='.$this->email;

        return new Content(
            view: 'email.subscriber',
            with: [
                'content' => $this->content,
                'unsubscribe' => $unsubscribe,
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
