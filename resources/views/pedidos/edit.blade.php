@extends('layouts.app')
@section('titulo', 'Editar Pedido #' . $pedido->id)

@section('conteudo')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('pedidos.show', $pedido) }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar Pedido #{{ $pedido->id }}</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('pedidos.update', $pedido) }}" class="space-y-4">
            @csrf @method('PATCH')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                <select name="cliente_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $pedido->cliente_id) == $cliente->id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                    @foreach(['pendente' => 'Pendente', 'em_producao' => 'Em Produção', 'concluido' => 'Concluído', 'cancelado' => 'Cancelado'] as $val => $label)
                    <option value="{{ $val }}" {{ old('status', $pedido->status) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                <p class="mt-1 text-xs text-gray-400">Ao mudar o status, o cliente receberá um e-mail de notificação.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
                <textarea name="observacoes" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('observacoes', $pedido->observacoes) }}</textarea>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Itens do pedido ({{ $pedido->itens->count() }} itens)</p>
                @foreach($pedido->itens as $item)
                <div class="flex justify-between text-sm text-gray-600">
                    <span>{{ $item->produto->nome }} × {{ $item->quantidade }}</span>
                    <span>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</span>
                </div>
                @endforeach
                <div class="flex justify-between font-bold text-gray-800 mt-2 pt-2 border-t border-gray-200">
                    <span>Total</span>
                    <span>R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('pedidos.show', $pedido) }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Pedido</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
