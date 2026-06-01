@extends('layouts.app')
@section('titulo', 'Registrar Movimentação')

@section('conteudo')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('estoque.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Registrar Movimentação de Estoque</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('movimentacoes.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Produto <span class="text-red-500">*</span></label>
                <select name="produto_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('produto_id') border-red-500 @enderror">
                    <option value="">Selecione o produto</option>
                    @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}"
                        {{ old('produto_id', request('produto')) == $produto->id ? 'selected' : '' }}>
                        {{ $produto->nome }} (Estoque: {{ $produto->estoque?->quantidade ?? 0 }})
                    </option>
                    @endforeach
                </select>
                @error('produto_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo <span class="text-red-500">*</span></label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo" value="entrada" {{ old('tipo', 'entrada') === 'entrada' ? 'checked' : '' }} class="text-blue-600">
                        <span class="text-sm text-green-700 font-medium">Entrada</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipo" value="saida" {{ old('tipo') === 'saida' ? 'checked' : '' }} class="text-blue-600">
                        <span class="text-sm text-red-700 font-medium">Saída</span>
                    </label>
                </div>
                @error('tipo')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <x-input-field label="Quantidade" name="quantidade" type="number" required placeholder="1" />
            <x-input-field label="Motivo" name="motivo" required placeholder="Ex: Compra de materiais, Uso na produção..." />

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('estoque.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Registrar Movimentação</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
