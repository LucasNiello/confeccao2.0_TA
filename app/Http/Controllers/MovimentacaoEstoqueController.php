<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovimentacaoEstoqueRequest;
use App\Models\MovimentacaoEstoque;
use App\Models\Produto;

class MovimentacaoEstoqueController extends Controller
{
    public function index()
    {
        $movimentacoes = MovimentacaoEstoque::with(['produto', 'usuario'])
            ->latest()
            ->paginate(15);

        return view('movimentacoes.index', compact('movimentacoes'));
    }

    public function create()
    {
        $produtos = Produto::with('estoque')->orderBy('nome')->get();

        return view('movimentacoes.create', compact('produtos'));
    }

    public function store(StoreMovimentacaoEstoqueRequest $request)
    {
        MovimentacaoEstoque::create([
            'produto_id' => $request->produto_id,
            'usuario_id' => auth()->id(),
            'tipo'       => $request->tipo,
            'quantidade' => $request->quantidade,
            'motivo'     => $request->motivo,
        ]);

        return redirect()->route('estoque.index')
            ->with('sucesso', 'Movimentação registrada com sucesso.');
    }
}
