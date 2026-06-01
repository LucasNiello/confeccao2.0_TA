@extends('layouts.app')
@section('titulo', 'Cliente: ' . $cliente->nome)

@section('conteudo')
<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('clientes.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-gray-800">{{ $cliente->nome }}</h2>
        </div>
        <a href="{{ route('clientes.edit', $cliente) }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">
            Editar
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-4">Dados do Cliente</h3>
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-xs text-gray-400">Nome</dt><dd class="text-sm font-medium text-gray-800">{{ $cliente->nome }}</dd></div>
            <div><dt class="text-xs text-gray-400">CPF / CNPJ</dt><dd class="text-sm text-gray-800">{{ $cliente->cpf_cnpj }}</dd></div>
            <div><dt class="text-xs text-gray-400">E-mail</dt><dd class="text-sm text-gray-800">{{ $cliente->email }}</dd></div>
            <div><dt class="text-xs text-gray-400">Telefone</dt><dd class="text-sm text-gray-800">{{ $cliente->telefone }}</dd></div>
            <div class="col-span-2"><dt class="text-xs text-gray-400">Endereço</dt><dd class="text-sm text-gray-800">{{ $cliente->endereco }}</dd></div>
        </dl>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-4">Histórico de Pedidos ({{ $cliente->pedidos->count() }})</h3>
        <div class="space-y-2">
            @forelse($cliente->pedidos->sortByDesc('created_at') as $pedido)
            <a href="{{ route('pedidos.show', $pedido) }}" class="flex items-center justify-between p-3 rounded-lg border border-gray-100 hover:bg-gray-50">
                <span class="text-sm font-medium text-gray-800">Pedido #{{ $pedido->id }}</span>
                <span class="text-xs text-gray-400">{{ $pedido->created_at->format('d/m/Y') }}</span>
                <span class="text-sm font-semibold text-gray-800">R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
            </a>
            @empty
            <p class="text-sm text-gray-400">Nenhum pedido registrado para este cliente.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
