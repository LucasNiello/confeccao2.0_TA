@extends('layouts.app')
@section('titulo', 'Funcionário')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('funcionarios.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-gray-800">{{ $funcionario->usuario->name }}</h2>
        </div>
        <a href="{{ route('funcionarios.edit', $funcionario) }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">Editar</a>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-xs text-gray-400">Nome</dt><dd class="text-sm font-medium text-gray-800">{{ $funcionario->usuario->name }}</dd></div>
            <div><dt class="text-xs text-gray-400">E-mail</dt><dd class="text-sm text-gray-800">{{ $funcionario->usuario->email }}</dd></div>
            <div><dt class="text-xs text-gray-400">Cargo</dt><dd class="text-sm text-gray-800">{{ $funcionario->cargo->nome }}</dd></div>
            <div><dt class="text-xs text-gray-400">CPF</dt><dd class="text-sm text-gray-800">{{ $funcionario->cpf }}</dd></div>
            <div><dt class="text-xs text-gray-400">Telefone</dt><dd class="text-sm text-gray-800">{{ $funcionario->telefone }}</dd></div>
            <div><dt class="text-xs text-gray-400">Admissão</dt><dd class="text-sm text-gray-800">{{ $funcionario->data_admissao->format('d/m/Y') }}</dd></div>
            <div><dt class="text-xs text-gray-400">Status</dt>
                <dd><span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $funcionario->status === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">{{ ucfirst($funcionario->status) }}</span></dd>
            </div>
        </dl>
    </div>
</div>
@endsection
