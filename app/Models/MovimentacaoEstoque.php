<?php

namespace App\Models;

use App\Notifications\EstoqueBaixoNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoque extends Model
{
    use HasFactory;

    protected $table = 'movimentacoes_estoque';

    protected $fillable = [
        'produto_id',
        'usuario_id',
        'tipo',
        'quantidade',
        'motivo',
    ];

    protected function casts(): array
    {
        return [
            'quantidade' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::created(function (MovimentacaoEstoque $movimentacao) {
            $estoque = Estoque::where('produto_id', $movimentacao->produto_id)->first();

            if (!$estoque) {
                return;
            }

            if ($movimentacao->tipo === 'entrada') {
                $estoque->increment('quantidade', $movimentacao->quantidade);
            } else {
                $estoque->decrement('quantidade', $movimentacao->quantidade);
            }

            $estoque->refresh();

            if ($estoque->estaBaixo()) {
                $admins = User::where('perfil', 'admin')->where('ativo', true)->get();
                foreach ($admins as $admin) {
                    $admin->notify(new EstoqueBaixoNotification($estoque));
                }
            }
        });
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
