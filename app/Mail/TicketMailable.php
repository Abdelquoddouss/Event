<?php

namespace App\Mail;

use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    /**
     * Create a new message instance.
     */
     public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }


    public function build()
    {
        return $this->view('emails.ticket');
               
    }



    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Mailable',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket',
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
