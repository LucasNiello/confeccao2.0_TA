@extends('layouts.app')
@section('titulo', 'Editar Funcionário')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('funcionarios.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar Funcionário</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">

        @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-sm font-medium text-red-700 mb-1">Corrija os erros abaixo antes de salvar:</p>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('funcionarios.update', $funcionario) }}" class="space-y-4">
            @csrf @method('PATCH')
            <h3 class="text-sm font-semibold text-gray-500 uppercase">Dados de Acesso</h3>
            <x-input-field label="Nome completo" name="name" required :value="$funcionario->usuario->name" />
            <x-input-field label="E-mail" name="email" type="email" required :value="$funcionario->usuario->email" />

            <h3 class="text-sm font-semibold text-gray-500 uppercase pt-2 border-t">Dados do Funcionário</h3>
            @php
                $cargosJson = $cargos->mapWithKeys(fn($c) => [
                    $c->id => ['nome' => $c->nome, 'descricao' => $c->descricao ?? '']
                ])->toJson();
            @endphp

            <div x-data="{ cargoSelecionado: '{{ old('cargo_id', $funcionario->cargo_id) }}', cargos: {{ $cargosJson }} }">
                <label class="block text-sm font-medium text-gray-700 mb-1">Cargo <span class="text-red-500">*</span></label>
                <select name="cargo_id" required x-model="cargoSelecionado"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cargo_id') border-red-500 @else border-gray-300 @enderror">
                    @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id', $funcionario->cargo_id) == $cargo->id ? 'selected' : '' }}>{{ $cargo->nome }}</option>
                    @endforeach
                </select>
                <p x-show="cargoSelecionado && cargos[cargoSelecionado] && cargos[cargoSelecionado].descricao"
                   x-text="cargos[cargoSelecionado] ? cargos[cargoSelecionado].descricao : ''"
                   class="mt-1 text-xs text-gray-500 italic"></p>
                @error('cargo_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="CPF" name="cpf" required :value="$funcionario->cpf" placeholder="000.000.000-00" />
                <x-input-field label="Telefone" name="telefone" required :value="$funcionario->telefone" placeholder="(19) 99999-9999" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-input-field label="Data de Admissão" name="data_admissao" type="date" required :value="$funcionario->data_admissao->format('Y-m-d')" />
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @else border-gray-300 @enderror">
                        <option value="ativo"   {{ old('status', $funcionario->status) === 'ativo'   ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status', $funcionario->status) === 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('funcionarios.show', $funcionario) }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Funcionário</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
