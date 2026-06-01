<?php

namespace App\Notifications;

use App\Models\Estoque;
use Illuminate\Notifications\Notification;

class EstoqueBaixoNotification extends Notification
{
    public function __construct(public Estoque $estoque) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'produto_id'         => $this->estoque->produto_id,
            'produto_nome'       => $this->estoque->produto->nome,
            'quantidade_atual'   => $this->estoque->quantidade,
            'quantidade_minima'  => $this->estoque->quantidade_minima,
            'mensagem'           => "Estoque baixo: {$this->estoque->produto->nome} ({$this->estoque->quantidade} unidades)",
            'link'               => route('estoque.index'),
        ];
    }
}
