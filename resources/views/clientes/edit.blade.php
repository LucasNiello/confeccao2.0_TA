@extends('layouts.app')
@section('titulo', 'Editar Cliente')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('clientes.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar Cliente</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('clientes.update', $cliente) }}" class="space-y-4">
            @csrf @method('PATCH')
            <x-input-field label="Nome completo" name="nome" required :value="$cliente->nome" />
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="CPF / CNPJ" name="cpf_cnpj" required :value="$cliente->cpf_cnpj" />
                <x-input-field label="Telefone" name="telefone" required :value="$cliente->telefone" />
            </div>
            <x-input-field label="E-mail" name="email" type="email" required :value="$cliente->email" />
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Endereço <span class="text-red-500">*</span></label>
                <input type="text" name="endereco" value="{{ old('endereco', $cliente->endereco) }}" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('endereco') border-red-500 @enderror">
                @error('endereco')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('clientes.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Cliente</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
