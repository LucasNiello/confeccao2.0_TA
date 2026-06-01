<?php

namespace App\Mail;

use App\Models\Funcionario;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FuncionarioCadastradoMail extends Mailable
{
    use SerializesModels;

    public function __construct(public Funcionario $funcionario) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem-vindo ao sistema — Confecção TA',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.funcionario-cadastrado',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
