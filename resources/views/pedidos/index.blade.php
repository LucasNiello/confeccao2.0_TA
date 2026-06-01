@extends('layouts.app')
@section('titulo', 'Pedidos')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Pedidos</h2>
    </div>
    <a href="{{ route('pedidos.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">+ Novo Pedido</a>
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b border-gray-100 flex gap-2 flex-wrap">
        <form method="GET" class="flex flex-1 gap-2">
            <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar por cliente..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos os status</option>
                @foreach(['pendente' => 'Pendente', 'em_producao' => 'Em Produção', 'concluido' => 'Concluído', 'cancelado' => 'Cancelado'] as $val => $label)
                <option value="{{ $val }}" {{ $status === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800">Filtrar</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">#</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Cliente</th>
                    <th class="text-center px-4 py-3 text-gray-500 font-medium">Status</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Total</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Data</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pedidos as $pedido)
                @php
                    $cor = match($pedido->status) {
                        'pendente' => 'yellow', 'em_producao' => 'blue',
                        'concluido' => 'green', 'cancelado' => 'red', default => 'gray'
                    };
                @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-400">#{{ $pedido->id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $pedido->cliente->nome }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $cor }}-100 text-{{ $cor }}-800">
                            {{ $pedido->statusLabel() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right font-semibold text-gray-800">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td class="px-4 py-3 text-right text-gray-400">{{ $pedido->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('pedidos.show', $pedido) }}" class="text-blue-600 hover:underline text-xs">Ver</a>
                            <a href="{{ route('pedidos.edit', $pedido) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                            @if(auth()->user()->perfil === 'admin')
                            <form method="POST" action="{{ route('pedidos.destroy', $pedido) }}" onsubmit="return confirm('Excluir?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">Nenhum pedido encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pedidos->hasPages())
    <div class="px-4 py-3 border-t">{{ $pedidos->links() }}</div>
    @endif
</div>
@endsection
