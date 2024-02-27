<?php

namespace App\Mail\Booking;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Confirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Booking $booking
    )
    { }

    /**
     * Get the message envelope.
     */
    public
    function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('library@support.com', 'Library Support Center'),
            subject: 'Booking successfully',
        );
    }

    /**
     * Get the message content definition.
     */
    public
    function content(): Content
    {
        return new Content(
            view: 'mail.booking.confirmed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public
    function attachments(): array
    {
        return [];
    }
}
