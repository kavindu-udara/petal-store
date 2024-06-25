<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Mail\AttachmentFromContent;

class InvoiceMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $orderId;
    // public $content;
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Get the message envelope.
     */
    // public function build(): self
    // {
    //     return route('user.invoice', ['orderId' => $orderId]);
    // }

    public function content(): Content
    {
        return new Content(
            view: 'mails.orderSucess'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            //
        ];
    }
}
