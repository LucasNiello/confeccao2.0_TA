@extends('layouts.app')
@section('titulo', 'Editar Usuário')

@section('conteudo')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('usuarios.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar: {{ $usuario->name }}</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="space-y-4">
            @csrf @method('PATCH')
            <x-input-field label="Nome completo" name="name" required :value="$usuario->name" />
            <x-input-field label="E-mail" name="email" type="email" required :value="$usuario->email" />
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Perfil</label>
                <select name="perfil" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="funcionario" {{ old('perfil', $usuario->perfil) === 'funcionario' ? 'selected' : '' }}>Funcionário</option>
                    <option value="admin" {{ old('perfil', $usuario->perfil) === 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="ativo" value="1" {{ old('ativo', $usuario->ativo) ? 'checked' : '' }} class="rounded">
                <span class="text-sm text-gray-700">Usuário ativo</span>
            </label>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('usuarios.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Usuário</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
