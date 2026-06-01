<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoCriadoMail extends Mailable
{
    use SerializesModels;

    public function __construct(public Pedido $pedido) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Pedido #{$this->pedido->id} recebido — Confecção TA",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido-criado',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
