@extends('layouts.app')
@section('titulo', 'Pedido #' . $pedido->id)

@section('conteudo')
@php
    $cor = match($pedido->status) {
        'pendente' => 'yellow', 'em_producao' => 'blue',
        'concluido' => 'green', 'cancelado' => 'red', default => 'gray'
    };
@endphp
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('pedidos.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-gray-800">Pedido #{{ $pedido->id }}</h2>
            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $cor }}-100 text-{{ $cor }}-800">{{ $pedido->statusLabel() }}</span>
        </div>
        <a href="{{ route('pedidos.edit', $pedido) }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">Editar Status</a>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-xs text-gray-400 mb-2">Cliente</p>
            <p class="font-semibold text-gray-800">{{ $pedido->cliente->nome }}</p>
            <p class="text-sm text-gray-500">{{ $pedido->cliente->email }}</p>
            <p class="text-sm text-gray-500">{{ $pedido->cliente->telefone }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <p class="text-xs text-gray-400 mb-2">Informações</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Atendente:</span> {{ $pedido->funcionario?->usuario->name ?? '—' }}</p>
            <p class="text-sm text-gray-600"><span class="font-medium">Data:</span> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            @if($pedido->observacoes)
            <p class="text-sm text-gray-600 mt-2">{{ $pedido->observacoes }}</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-500 mb-4">Itens do Pedido</h3>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="text-left pb-2 text-gray-500 font-medium">Produto</th>
                    <th class="text-center pb-2 text-gray-500 font-medium">Qtd</th>
                    <th class="text-right pb-2 text-gray-500 font-medium">Preço Unit.</th>
                    <th class="text-right pb-2 text-gray-500 font-medium">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($pedido->itens as $item)
                <tr>
                    <td class="py-2 text-gray-800">{{ $item->produto->nome }}</td>
                    <td class="py-2 text-center text-gray-600">{{ $item->quantidade }}</td>
                    <td class="py-2 text-right text-gray-600">R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                    <td class="py-2 text-right font-medium text-gray-800">R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="pt-4 text-right font-semibold text-gray-700">Total:</td>
                    <td class="pt-4 text-right text-xl font-bold text-blue-700">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
