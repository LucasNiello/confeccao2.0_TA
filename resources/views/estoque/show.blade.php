@extends('layouts.app')
@section('titulo', 'Estoque: ' . $estoque->produto->nome)

@section('conteudo')
<div class="max-w-3xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('estoque.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">{{ $estoque->produto->nome }}</h2>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <p class="text-xs text-gray-400 mb-1">Saldo Atual</p>
            <p class="text-3xl font-bold {{ $estoque->estaBaixo() ? 'text-red-600' : 'text-green-600' }}">{{ $estoque->quantidade }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <p class="text-xs text-gray-400 mb-1">Quantidade Mínima</p>
            <p class="text-3xl font-bold text-gray-800">{{ $estoque->quantidade_minima }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5 text-center">
            <p class="text-xs text-gray-400 mb-1">Status</p>
            <span class="inline-flex mt-2 px-3 py-1 rounded-full text-sm font-medium {{ $estoque->estaBaixo() ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                {{ $estoque->estaBaixo() ? 'Crítico' : 'Normal' }}
            </span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-gray-500">Histórico de Movimentações</h3>
            <a href="{{ route('movimentacoes.create') }}?produto={{ $estoque->produto_id }}"
               class="text-sm text-blue-600 hover:underline">+ Registrar</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($estoque->produto->movimentacoes as $mov)
            <div class="py-3 flex items-center justify-between">
                <div>
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium mr-2 {{ $mov->tipo === 'entrada' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($mov->tipo) }}
                    </span>
                    <span class="text-sm text-gray-600">{{ $mov->motivo }}</span>
                    <span class="text-xs text-gray-400 ml-2">por {{ $mov->usuario->name }}</span>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold {{ $mov->tipo === 'entrada' ? 'text-green-700' : 'text-red-700' }}">
                        {{ $mov->tipo === 'entrada' ? '+' : '-' }}{{ $mov->quantidade }}
                    </p>
                    <p class="text-xs text-gray-400">{{ $mov->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">Nenhuma movimentação registrada.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
