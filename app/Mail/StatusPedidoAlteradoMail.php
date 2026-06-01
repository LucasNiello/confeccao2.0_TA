<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusPedidoAlteradoMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public Pedido $pedido,
        public string $statusAnterior
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Atualização do Pedido #{$this->pedido->id} — Confecção TA",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.status-pedido-alterado',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
