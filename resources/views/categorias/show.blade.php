@extends('layouts.app')
@section('titulo', 'Categoria')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('categorias.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">{{ $categoria->nome }}</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
        <p class="text-sm text-gray-600">{{ $categoria->descricao ?? '—' }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-500 mb-3">Produtos ({{ $categoria->produtos->count() }})</h3>
        <div class="divide-y divide-gray-50">
            @forelse($categoria->produtos as $produto)
            <div class="py-2 flex justify-between">
                <span class="text-sm text-gray-800">{{ $produto->nome }}</span>
                <span class="text-sm text-gray-500">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400">Nenhum produto nesta categoria.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
