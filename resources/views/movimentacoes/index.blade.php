@extends('layouts.app')
@section('titulo', 'Movimentações de Estoque')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Movimentações de Estoque</h2>
    <a href="{{ route('movimentacoes.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">+ Registrar</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Produto</th>
                <th class="text-center px-4 py-3 text-gray-500 font-medium">Tipo</th>
                <th class="text-center px-4 py-3 text-gray-500 font-medium">Quantidade</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Motivo</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Usuário</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Data</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($movimentacoes as $mov)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $mov->produto->nome }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $mov->tipo === 'entrada' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($mov->tipo) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center font-semibold {{ $mov->tipo === 'entrada' ? 'text-green-700' : 'text-red-700' }}">
                    {{ $mov->tipo === 'entrada' ? '+' : '-' }}{{ $mov->quantidade }}
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $mov->motivo }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $mov->usuario->name }}</td>
                <td class="px-4 py-3 text-right text-gray-400">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">Nenhuma movimentação registrada.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($movimentacoes->hasPages())
    <div class="px-4 py-3 border-t">{{ $movimentacoes->links() }}</div>
    @endif
</div>
@endsection
