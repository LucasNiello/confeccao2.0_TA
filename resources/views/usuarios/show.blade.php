@extends('layouts.app')
@section('titulo', 'Usuário')

@section('conteudo')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('usuarios.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">{{ $usuario->name }}</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-xs text-gray-400">Nome</dt><dd class="text-sm font-medium text-gray-800">{{ $usuario->name }}</dd></div>
            <div><dt class="text-xs text-gray-400">E-mail</dt><dd class="text-sm text-gray-800">{{ $usuario->email }}</dd></div>
            <div><dt class="text-xs text-gray-400">Perfil</dt><dd class="text-sm text-gray-800 capitalize">{{ $usuario->perfil }}</dd></div>
            <div><dt class="text-xs text-gray-400">Status</dt>
                <dd><span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $usuario->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $usuario->ativo ? 'Ativo' : 'Inativo' }}</span></dd>
            </div>
            @if($usuario->funcionario)
            <div class="col-span-2"><dt class="text-xs text-gray-400">Cargo</dt><dd class="text-sm text-gray-800">{{ $usuario->funcionario->cargo->nome }}</dd></div>
            @endif
        </dl>
    </div>
</div>
@endsection
