@extends('layouts.app')
@section('titulo', 'Fornecedor')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('fornecedores.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-gray-800">{{ $fornecedor->razao_social }}</h2>
        </div>
        <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">Editar</a>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-xs text-gray-400">Razão Social</dt><dd class="text-sm font-medium text-gray-800">{{ $fornecedor->razao_social }}</dd></div>
            <div><dt class="text-xs text-gray-400">CNPJ</dt><dd class="text-sm text-gray-800">{{ $fornecedor->cnpj }}</dd></div>
            <div><dt class="text-xs text-gray-400">E-mail</dt><dd class="text-sm text-gray-800">{{ $fornecedor->email }}</dd></div>
            <div><dt class="text-xs text-gray-400">Telefone</dt><dd class="text-sm text-gray-800">{{ $fornecedor->telefone }}</dd></div>
            <div><dt class="text-xs text-gray-400">Tipo de Material</dt><dd class="text-sm text-gray-800 capitalize">{{ str_replace('_', ' ', $fornecedor->tipo_material) }}</dd></div>
        </dl>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-500 mb-3">Produtos fornecidos ({{ $fornecedor->produtos->count() }})</h3>
        <div class="space-y-2">
            @forelse($fornecedor->produtos as $produto)
            <a href="{{ route('produtos.show', $produto) }}" class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-gray-50">
                <span class="text-sm font-medium text-gray-800">{{ $produto->nome }}</span>
                <span class="text-sm text-gray-600">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</span>
            </a>
            @empty
            <p class="text-sm text-gray-400">Nenhum produto vinculado.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
