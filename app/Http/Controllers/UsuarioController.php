<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('name')->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(StoreUsuarioRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'perfil'   => $request->perfil,
            'ativo'    => $request->boolean('ativo', true),
        ]);

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário criado com sucesso.');
    }

    public function show(User $usuario)
    {
        $usuario->load('funcionario.cargo');

        return view('usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(UpdateUsuarioRequest $request, User $usuario)
    {
        $usuario->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'perfil' => $request->perfil,
            'ativo'  => $request->boolean('ativo', true),
        ]);

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('sucesso', 'Usuário excluído com sucesso.');
    }
}
