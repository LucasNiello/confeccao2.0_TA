<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::withCount('funcionarios')->paginate(10);

        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(StoreCargoRequest $request)
    {
        Cargo::create($request->validated());

        return redirect()->route('cargos.index')
            ->with('sucesso', 'Cargo cadastrado com sucesso.');
    }

    public function show(Cargo $cargo)
    {
        $cargo->load('funcionarios.usuario');

        return view('cargos.show', compact('cargo'));
    }

    public function edit(Cargo $cargo)
    {
        return view('cargos.edit', compact('cargo'));
    }

    public function update(UpdateCargoRequest $request, Cargo $cargo)
    {
        $cargo->update($request->validated());

        return redirect()->route('cargos.index')
            ->with('sucesso', 'Cargo atualizado com sucesso.');
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();

        return redirect()->route('cargos.index')
            ->with('sucesso', 'Cargo excluído com sucesso.');
    }
}
