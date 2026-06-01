@extends('layouts.app')
@section('titulo', 'Novo Funcionário')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('funcionarios.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Novo Funcionário</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">
        <form method="POST" action="{{ route('funcionarios.store') }}" class="space-y-4">
            @csrf
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Dados de Acesso</h3>
            <x-input-field label="Nome completo" name="name" required />
            <x-input-field label="E-mail" name="email" type="email" required />
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="Senha" name="password" type="password" required />
                <x-input-field label="Confirmar senha" name="password_confirmation" type="password" required />
            </div>

            <h3 class="text-sm font-semibold text-gray-500 uppercase pt-2 border-t border-gray-100">Dados do Funcionário</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cargo <span class="text-red-500">*</span></label>
                <select name="cargo_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cargo_id') border-red-500 @enderror">
                    <option value="">Selecione o cargo</option>
                    @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>{{ $cargo->nome }}</option>
                    @endforeach
                </select>
                @error('cargo_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="CPF" name="cpf" required placeholder="000.000.000-00" />
                <x-input-field label="Telefone" name="telefone" required placeholder="(19) 99999-9999" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="Data de Admissão" name="data_admissao" type="date" required />
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="ativo" {{ old('status', 'ativo') === 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status') === 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('funcionarios.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Cadastrar Funcionário</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
