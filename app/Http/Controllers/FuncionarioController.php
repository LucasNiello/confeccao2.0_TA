<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\UpdateFuncionarioRequest;
use App\Mail\FuncionarioCadastradoMail;
use App\Models\Cargo;
use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::with(['usuario', 'cargo'])
            ->paginate(10);

        return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        $cargos = Cargo::orderBy('nome')->get();

        return view('funcionarios.create', compact('cargos'));
    }

    public function store(StoreFuncionarioRequest $request)
    {
        DB::transaction(function () use ($request) {
            $usuario = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'perfil'   => 'funcionario',
                'ativo'    => true,
            ]);

            $funcionario = Funcionario::create([
                'usuario_id'    => $usuario->id,
                'cargo_id'      => $request->cargo_id,
                'cpf'           => $request->cpf,
                'telefone'      => $request->telefone,
                'data_admissao' => $request->data_admissao,
                'status'        => $request->status,
            ]);

            Mail::to($usuario->email)->send(new FuncionarioCadastradoMail($funcionario->load('cargo', 'usuario')));
        });

        return redirect()->route('funcionarios.index')
            ->with('sucesso', 'Funcionário cadastrado com sucesso. E-mail de boas-vindas enviado.');
    }

    public function show(Funcionario $funcionario)
    {
        $funcionario->load(['usuario', 'cargo']);

        return view('funcionarios.show', compact('funcionario'));
    }

    public function edit(Funcionario $funcionario)
    {
        $cargos = Cargo::orderBy('nome')->get();
        $funcionario->load('usuario');

        return view('funcionarios.edit', compact('funcionario', 'cargos'));
    }

    public function update(UpdateFuncionarioRequest $request, Funcionario $funcionario)
    {
        DB::transaction(function () use ($request, $funcionario) {
            $funcionario->usuario->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);

            $funcionario->update([
                'cargo_id'      => $request->cargo_id,
                'cpf'           => $request->cpf,
                'telefone'      => $request->telefone,
                'data_admissao' => $request->data_admissao,
                'status'        => $request->status,
            ]);
        });

        return redirect()->route('funcionarios.index')
            ->with('sucesso', 'Funcionário atualizado com sucesso.');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->usuario->delete();

        return redirect()->route('funcionarios.index')
            ->with('sucesso', 'Funcionário excluído com sucesso.');
    }
}
