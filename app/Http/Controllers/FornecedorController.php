<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        $busca = request('busca');

        $fornecedores = Fornecedor::when($busca, function ($query) use ($busca) {
                $query->where('razao_social', 'like', "%{$busca}%")
                      ->orWhere('cnpj', 'like', "%{$busca}%");
            })
            ->orderBy('razao_social')
            ->paginate(10)
            ->withQueryString();

        return view('fornecedores.index', compact('fornecedores', 'busca'));
    }

    public function create()
    {
        return view('fornecedores.create');
    }

    public function store(StoreFornecedorRequest $request)
    {
        Fornecedor::create($request->validated());

        return redirect()->route('fornecedores.index')
            ->with('sucesso', 'Fornecedor cadastrado com sucesso.');
    }

    public function show(Fornecedor $fornecedor)
    {
        $fornecedor->load('produtos');

        return view('fornecedores.show', compact('fornecedor'));
    }

    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(UpdateFornecedorRequest $request, Fornecedor $fornecedor)
    {
        $fornecedor->update($request->validated());

        return redirect()->route('fornecedores.index')
            ->with('sucesso', 'Fornecedor atualizado com sucesso.');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')
            ->with('sucesso', 'Fornecedor excluído com sucesso.');
    }
}
