<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    private string $destination = '';
    private string $email = '';
    private string $name = '';
    private string $content = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($destination, $name, $email, $content)
    {
        $this->name = $name;
        $this->email = $email;
        $this->content = $content;
        $this->destination = $destination;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->destination,
            replyTo: $this->email,
            subject: 'New Request Support Message',

        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.request-received',
            with: [
                'name' => $this->name,
                'content' => $this->content,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
