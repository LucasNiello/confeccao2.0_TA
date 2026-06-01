<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $clientes     = Cliente::all()->values();
        $funcionarios = Funcionario::all()->values();
        $produtos     = Produto::all()->values();

        $pedidosData = [
            ['status' => 'concluido',    'cliente_idx' => 0, 'itens' => [[0, 2], [5, 1]]],
            ['status' => 'em_producao',  'cliente_idx' => 1, 'itens' => [[10, 3], [11, 1]]],
            ['status' => 'pendente',     'cliente_idx' => 2, 'itens' => [[1, 5], [2, 2]]],
            ['status' => 'concluido',    'cliente_idx' => 3, 'itens' => [[6, 2]]],
            ['status' => 'cancelado',    'cliente_idx' => 4, 'itens' => [[13, 1]]],
            ['status' => 'em_producao',  'cliente_idx' => 5, 'itens' => [[8, 4], [9, 2]]],
            ['status' => 'pendente',     'cliente_idx' => 6, 'itens' => [[3, 1], [4, 10]]],
            ['status' => 'concluido',    'cliente_idx' => 7, 'itens' => [[12, 2], [14, 3]]],
        ];

        foreach ($pedidosData as $idx => $dados) {
            $cliente    = $clientes[$dados['cliente_idx']];
            $funcionario= $funcionarios[$idx % $funcionarios->count()];

            $pedido = Pedido::create([
                'cliente_id'     => $cliente->id,
                'funcionario_id' => $funcionario->id,
                'status'         => $dados['status'],
                'total'          => 0,
                'observacoes'    => null,
            ]);

            $total = 0;
            foreach ($dados['itens'] as [$prodIdx, $qtd]) {
                if (!$produtos->has($prodIdx)) continue;
                $produto  = $produtos[$prodIdx];
                $subtotal = $qtd * $produto->preco_venda;
                ItemPedido::create([
                    'pedido_id'      => $pedido->id,
                    'produto_id'     => $produto->id,
                    'quantidade'     => $qtd,
                    'preco_unitario' => $produto->preco_venda,
                    'subtotal'       => $subtotal,
                ]);
                $total += $subtotal;
            }

            $pedido->update(['total' => $total]);
        }
    }
}
