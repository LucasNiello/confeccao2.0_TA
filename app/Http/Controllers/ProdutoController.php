<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Estoque;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index()
    {
        $busca = request('busca');

        $produtos = Produto::with(['categoria', 'estoque'])
            ->when($busca, fn ($q) => $q->where('nome', 'like', "%{$busca}%"))
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('produtos.index', compact('produtos', 'busca'));
    }

    public function create()
    {
        $categorias  = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('razao_social')->get();

        return view('produtos.create', compact('categorias', 'fornecedores'));
    }

    public function store(StoreProdutoRequest $request)
    {
        DB::transaction(function () use ($request) {
            $dados = $request->safe()->except('quantidade_minima');
            $produto = Produto::create($dados);

            Estoque::create([
                'produto_id'       => $produto->id,
                'quantidade'       => 0,
                'quantidade_minima'=> $request->quantidade_minima,
            ]);
        });

        return redirect()->route('produtos.index')
            ->with('sucesso', 'Produto cadastrado com sucesso.');
    }

    public function show(Produto $produto)
    {
        $produto->load(['categoria', 'fornecedor', 'estoque', 'movimentacoes.usuario']);

        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias   = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('razao_social')->get();
        $produto->load('estoque');

        return view('produtos.edit', compact('produto', 'categorias', 'fornecedores'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        DB::transaction(function () use ($request, $produto) {
            $dados = $request->safe()->except('quantidade_minima');
            $produto->update($dados);

            if ($produto->estoque) {
                $produto->estoque->update(['quantidade_minima' => $request->quantidade_minima]);
            } else {
                Estoque::create([
                    'produto_id'       => $produto->id,
                    'quantidade'       => 0,
                    'quantidade_minima'=> $request->quantidade_minima,
                ]);
            }
        });

        return redirect()->route('produtos.index')
            ->with('sucesso', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('sucesso', 'Produto excluído com sucesso.');
    }
}
