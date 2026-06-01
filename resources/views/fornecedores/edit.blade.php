@extends('layouts.app')
@section('titulo', 'Editar Fornecedor')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('fornecedores.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar Fornecedor</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('fornecedores.update', $fornecedor) }}" class="space-y-4">
            @csrf @method('PATCH')
            <x-input-field label="Razão Social" name="razao_social" required :value="$fornecedor->razao_social" />
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="CNPJ" name="cnpj" required :value="$fornecedor->cnpj" />
                <x-input-field label="Telefone" name="telefone" required :value="$fornecedor->telefone" />
            </div>
            <x-input-field label="E-mail" name="email" type="email" required :value="$fornecedor->email" />
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Material <span class="text-red-500">*</span></label>
                <select name="tipo_material" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach(['tecidos' => 'Tecidos', 'aviamentos' => 'Aviamentos', 'servicos' => 'Serviços', 'maquinario' => 'Maquinário', 'outros' => 'Outros'] as $val => $label)
                    <option value="{{ $val }}" {{ old('tipo_material', $fornecedor->tipo_material) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('fornecedores.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Fornecedor</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
