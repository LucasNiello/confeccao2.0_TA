@extends('layouts.app')
@section('titulo', 'Produto: ' . $produto->nome)

@section('conteudo')
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('produtos.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-gray-800">{{ $produto->nome }}</h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('movimentacoes.create') }}?produto={{ $produto->id }}" class="px-4 py-2 text-sm border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50">Movimentar Estoque</a>
            @if(auth()->user()->perfil === 'admin')
            <a href="{{ route('produtos.edit', $produto) }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">Editar</a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-5 col-span-2">
            <dl class="grid grid-cols-2 gap-4">
                <div><dt class="text-xs text-gray-400">Categoria</dt><dd class="text-sm font-medium text-gray-800">{{ $produto->categoria->nome }}</dd></div>
                <div><dt class="text-xs text-gray-400">Fornecedor</dt><dd class="text-sm text-gray-800">{{ $produto->fornecedor?->razao_social ?? '—' }}</dd></div>
                <div><dt class="text-xs text-gray-400">Preço de Custo</dt><dd class="text-sm text-gray-800">R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</dd></div>
                <div><dt class="text-xs text-gray-400">Preço de Venda</dt><dd class="text-sm font-bold text-blue-700">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</dd></div>
                @if($produto->descricao)
                <div class="col-span-2"><dt class="text-xs text-gray-400">Descrição</dt><dd class="text-sm text-gray-600">{{ $produto->descricao }}</dd></div>
                @endif
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-xs text-gray-400 mb-1">Estoque Atual</p>
            @if($produto->estoque)
            <p class="text-3xl font-bold {{ $produto->estoque->estaBaixo() ? 'text-red-600' : 'text-green-600' }}">
                {{ $produto->estoque->quantidade }}
            </p>
            <p class="text-xs text-gray-400 mt-1">Mínimo: {{ $produto->estoque->quantidade_minima }}</p>
            @if($produto->estoque->estaBaixo())
            <span class="inline-flex mt-2 px-2 py-0.5 rounded-full text-xs bg-red-100 text-red-700">Estoque Crítico</span>
            @endif
            @else
            <p class="text-gray-400 text-sm">Sem registro de estoque.</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-500 mb-3">Últimas Movimentações</h3>
        <div class="divide-y divide-gray-50">
            @forelse($produto->movimentacoes->take(10) as $mov)
            <div class="py-2 flex items-center justify-between">
                <div>
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium mr-2 {{ $mov->tipo === 'entrada' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($mov->tipo) }}
                    </span>
                    <span class="text-sm text-gray-600">{{ $mov->motivo }}</span>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold {{ $mov->tipo === 'entrada' ? 'text-green-700' : 'text-red-700' }}">
                        {{ $mov->tipo === 'entrada' ? '+' : '-' }}{{ $mov->quantidade }}
                    </p>
                    <p class="text-xs text-gray-400">{{ $mov->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4">Nenhuma movimentação registrada.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
