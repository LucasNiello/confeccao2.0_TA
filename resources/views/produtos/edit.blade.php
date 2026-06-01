@extends('layouts.app')
@section('titulo', 'Editar Produto')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('produtos.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar: {{ $produto->nome }}</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('produtos.update', $produto) }}" class="space-y-4">
            @csrf @method('PATCH')
            <x-input-field label="Nome do produto" name="nome" required :value="$produto->nome" />
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Categoria <span class="text-red-500">*</span></label>
                    <select name="categoria_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ old('categoria_id', $produto->categoria_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fornecedor</label>
                    <select name="fornecedor_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Nenhum</option>
                        @foreach($fornecedores as $forn)
                        <option value="{{ $forn->id }}" {{ old('fornecedor_id', $produto->fornecedor_id) == $forn->id ? 'selected' : '' }}>{{ $forn->razao_social }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descricao', $produto->descricao) }}</textarea>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <x-input-field label="Preço de Custo (R$)" name="preco_custo" type="number" required :value="$produto->preco_custo" />
                <x-input-field label="Preço de Venda (R$)" name="preco_venda" type="number" required :value="$produto->preco_venda" />
                <x-input-field label="Qtd. Mínima Estoque" name="quantidade_minima" type="number" required :value="$produto->estoque?->quantidade_minima ?? 5" />
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('produtos.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Produto</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
