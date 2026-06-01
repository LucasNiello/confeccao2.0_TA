<?php

namespace App\Http\Controllers;

use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index()
    {
        $busca = request('busca');
        $filtro = request('filtro');

        $estoques = Estoque::with(['produto.categoria'])
            ->when($busca, fn ($q) => $q->whereHas('produto', fn ($p) => $p->where('nome', 'like', "%{$busca}%")))
            ->when($filtro === 'baixo', fn ($q) => $q->whereColumn('quantidade', '<=', 'quantidade_minima'))
            ->paginate(15)
            ->withQueryString();

        return view('estoque.index', compact('estoques', 'busca', 'filtro'));
    }

    public function show(Estoque $estoque)
    {
        $estoque->load(['produto.categoria', 'produto.movimentacoes.usuario']);

        return view('estoque.show', compact('estoque'));
    }
}
