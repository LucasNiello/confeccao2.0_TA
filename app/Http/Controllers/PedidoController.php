<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Mail\PedidoCriadoMail;
use App\Mail\StatusPedidoAlteradoMail;
use App\Models\Cliente;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{
    public function index()
    {
        $status = request('status');
        $busca  = request('busca');

        $pedidos = Pedido::with(['cliente', 'funcionario'])
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($busca, fn ($q) => $q->whereHas('cliente', fn ($p) => $p->where('nome', 'like', "%{$busca}%")))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pedidos.index', compact('pedidos', 'status', 'busca'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $produtos = Produto::with('estoque')->orderBy('nome')->get();

        return view('pedidos.create', compact('clientes', 'produtos'));
    }

    public function store(StorePedidoRequest $request)
    {
        DB::transaction(function () use ($request) {
            $pedido = Pedido::create([
                'cliente_id'    => $request->cliente_id,
                'funcionario_id'=> auth()->user()->funcionario?->id,
                'status'        => 'pendente',
                'total'         => 0,
                'observacoes'   => $request->observacoes,
            ]);

            $total = 0;
            foreach ($request->itens as $item) {
                $subtotal = $item['quantidade'] * $item['preco_unitario'];
                ItemPedido::create([
                    'pedido_id'      => $pedido->id,
                    'produto_id'     => $item['produto_id'],
                    'quantidade'     => $item['quantidade'],
                    'preco_unitario' => $item['preco_unitario'],
                    'subtotal'       => $subtotal,
                ]);
                $total += $subtotal;
            }

            $pedido->update(['total' => $total]);

            $cliente = $pedido->cliente;
            if ($cliente->email) {
                Mail::to($cliente->email)->send(new PedidoCriadoMail($pedido->load('itens.produto')));
            }
        });

        return redirect()->route('pedidos.index')
            ->with('sucesso', 'Pedido criado com sucesso. E-mail de confirmação enviado ao cliente.');
    }

    public function show(Pedido $pedido)
    {
        $pedido->load(['cliente', 'funcionario.cargo', 'itens.produto']);

        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::orderBy('nome')->get();
        $pedido->load(['itens.produto', 'cliente']);

        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        $statusAnterior = $pedido->status;

        $pedido->update($request->validated());

        if ($statusAnterior !== $request->status) {
            $cliente = $pedido->cliente;
            if ($cliente->email) {
                Mail::to($cliente->email)->send(new StatusPedidoAlteradoMail($pedido, $statusAnterior));
            }
        }

        return redirect()->route('pedidos.show', $pedido)
            ->with('sucesso', 'Pedido atualizado com sucesso.');
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('sucesso', 'Pedido excluído com sucesso.');
    }
}
