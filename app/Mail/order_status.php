<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use Illuminate\Mail\Mailables\Address;

use App\Models\order;
use App\Models\order_items;

class order_status extends Mailable
{
    use Queueable, SerializesModels;

    private $order_id = '';
    private $status_id = '';

    private $billcode = '';

    /**
     * Create a new message instance.
     */
    public function __construct($order_id,$billcode,$status_id)
    {
        $this->order_id = $order_id;
        $this->status_id = $status_id;

        $this->billcode = $billcode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('admin@gmail.com', 'opad'),
            subject: 'Order Status',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $orders = order::firstWhere('reference', $this->order_id);
        $order_items = order_items::where('reference', $this->order_id)->get();

        return new Content(
            view: 'email.order_status',
            with: [
                'order' => $orders,
                'billcode'=> $this->billcode,
                'order_items' => $order_items,
                'status_id' => $this->status_id
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
