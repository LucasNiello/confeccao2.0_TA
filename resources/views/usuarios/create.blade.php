@extends('layouts.app')
@section('titulo', 'Novo Usuário')

@section('conteudo')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('usuarios.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Novo Usuário</h2>
    </div>

    <div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg px-4 py-3 text-sm text-blue-800">
        <strong>Atenção:</strong> Esta tela cria apenas o acesso de login ao sistema.
        Para cadastrar um <strong>funcionário completo</strong> (com CPF, cargo e data de admissão),
        use a seção <a href="{{ route('funcionarios.create') }}" class="underline font-semibold">Funcionários → Novo Funcionário</a>.
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-4">
            @csrf
            <x-input-field label="Nome completo" name="name" required />
            <x-input-field label="E-mail" name="email" type="email" required />
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="Senha" name="password" type="password" required />
                <x-input-field label="Confirmar senha" name="password_confirmation" type="password" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Perfil <span class="text-red-500">*</span></label>
                <select name="perfil" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="funcionario" {{ old('perfil') === 'funcionario' ? 'selected' : '' }}>Funcionário</option>
                    <option value="admin"       {{ old('perfil') === 'admin'       ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="ativo" value="1" {{ old('ativo', '1') ? 'checked' : '' }} class="rounded">
                <span class="text-sm text-gray-700">Usuário ativo</span>
            </label>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('usuarios.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Criar Usuário</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
