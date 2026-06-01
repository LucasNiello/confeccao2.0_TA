<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'funcionario_id',
        'status',
        'total',
        'observacoes',
    ];

    protected function casts(): array
    {
        return [
            'total' => 'decimal:2',
        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'pendente'     => 'Pendente',
            'em_producao'  => 'Em Produção',
            'concluido'    => 'Concluído',
            'cancelado'    => 'Cancelado',
            default        => $this->status,
        };
    }

    public function statusCor(): string
    {
        return match ($this->status) {
            'pendente'     => 'yellow',
            'em_producao'  => 'blue',
            'concluido'    => 'green',
            'cancelado'    => 'red',
            default        => 'gray',
        };
    }
}
