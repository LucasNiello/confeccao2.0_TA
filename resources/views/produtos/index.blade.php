@extends('layouts.app')
@section('titulo', 'Produtos')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Produtos</h2>
        <p class="text-sm text-gray-500">{{ $produtos->total() }} produtos</p>
    </div>
    @if(auth()->user()->perfil === 'admin')
    <a href="{{ route('produtos.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">+ Novo Produto</a>
    @endif
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b border-gray-100">
        <form method="GET" class="flex gap-2">
            <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar por nome..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800">Buscar</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Nome</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Categoria</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Custo</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Venda</th>
                    <th class="text-center px-4 py-3 text-gray-500 font-medium">Estoque</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($produtos as $produto)
                @php $estoqueBaixo = $produto->estoque && $produto->estoque->estaBaixo(); @endphp
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $produto->nome }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $produto->categoria->nome }}</td>
                    <td class="px-4 py-3 text-right text-gray-600">R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
                    <td class="px-4 py-3 text-right text-gray-800 font-medium">R$ {{ number_format($produto->preco_venda, 2, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $estoqueBaixo ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $produto->estoque?->quantidade ?? 0 }} un.
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('produtos.show', $produto) }}" class="text-blue-600 hover:underline text-xs">Ver</a>
                            @if(auth()->user()->perfil === 'admin')
                            <a href="{{ route('produtos.edit', $produto) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                            <form method="POST" action="{{ route('produtos.destroy', $produto) }}" onsubmit="return confirm('Excluir?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">Nenhum produto cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($produtos->hasPages())
    <div class="px-4 py-3 border-t">{{ $produtos->links() }}</div>
    @endif
</div>
@endsection
