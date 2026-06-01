@extends('layouts.app')
@section('titulo', 'Estoque')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Controle de Estoque</h2>
    <a href="{{ route('movimentacoes.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">
        + Registrar Movimentação
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b border-gray-100 flex gap-2">
        <form method="GET" class="flex flex-1 gap-2">
            <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar produto..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select name="filtro" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos</option>
                <option value="baixo" {{ $filtro === 'baixo' ? 'selected' : '' }}>Estoque Crítico</option>
            </select>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800">Filtrar</button>
            @if($busca || $filtro)
            <a href="{{ route('estoque.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Limpar</a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Produto</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Categoria</th>
                    <th class="text-center px-4 py-3 text-gray-500 font-medium">Quantidade</th>
                    <th class="text-center px-4 py-3 text-gray-500 font-medium">Mínimo</th>
                    <th class="text-center px-4 py-3 text-gray-500 font-medium">Status</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($estoques as $estoque)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $estoque->produto->nome }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $estoque->produto->categoria->nome }}</td>
                    <td class="px-4 py-3 text-center font-semibold {{ $estoque->estaBaixo() ? 'text-red-600' : 'text-gray-800' }}">
                        {{ $estoque->quantidade }}
                    </td>
                    <td class="px-4 py-3 text-center text-gray-500">{{ $estoque->quantidade_minima }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($estoque->estaBaixo())
                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Crítico</span>
                        @else
                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Normal</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('estoque.show', $estoque) }}" class="text-blue-600 hover:underline text-xs">Ver histórico</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">Nenhum produto em estoque.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($estoques->hasPages())
    <div class="px-4 py-3 border-t">{{ $estoques->links() }}</div>
    @endif
</div>
@endsection
