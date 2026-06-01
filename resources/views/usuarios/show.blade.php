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

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <dl class="grid grid-cols-2 gap-4">
            <div>
                <dt class="text-xs text-gray-400">Nome</dt>
                <dd class="text-sm font-medium text-gray-800">{{ $usuario->name }}</dd>
            </div>
            <div>
                <dt class="text-xs text-gray-400">E-mail</dt>
                <dd class="text-sm text-gray-800">{{ $usuario->email }}</dd>
            </div>
            <div>
                <dt class="text-xs text-gray-400">Perfil</dt>
                <dd>
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $usuario->perfil === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($usuario->perfil) }}
                    </span>
                </dd>
            </div>
            <div>
                <dt class="text-xs text-gray-400">Status</dt>
                <dd>
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $usuario->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                    </span>
                </dd>
            </div>
            @if($usuario->funcionario)
            <div class="col-span-2 border-t pt-3">
                <dt class="text-xs text-gray-400 mb-1">Cargo</dt>
                <dd class="text-sm text-gray-800">{{ $usuario->funcionario->cargo->nome }}</dd>
            </div>
            @endif
        </dl>

        {{-- Alerta: funcionário sem perfil completo --}}
        @if($usuario->perfil === 'funcionario' && !$usuario->funcionario)
        <div class="border-t pt-4">
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg px-4 py-3">
                <p class="text-sm text-yellow-800 font-medium">Perfil de funcionário incompleto</p>
                <p class="text-xs text-yellow-700 mt-1">
                    Este usuário tem acesso de login, mas não possui dados profissionais cadastrados
                    (CPF, cargo, data de admissão). Use a seção Funcionários para completar.
                </p>
                <a href="{{ route('funcionarios.create') }}"
                   class="mt-2 inline-flex items-center gap-1 text-xs font-semibold text-yellow-800 underline hover:text-yellow-900">
                    Completar cadastro como Funcionário →
                </a>
            </div>
        </div>
        @endif

        {{-- Link para o perfil de funcionário --}}
        @if($usuario->funcionario)
        <div class="border-t pt-3 flex justify-end">
            <a href="{{ route('funcionarios.show', $usuario->funcionario) }}"
               class="text-sm text-blue-600 hover:underline">
                Ver perfil completo de funcionário →
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
