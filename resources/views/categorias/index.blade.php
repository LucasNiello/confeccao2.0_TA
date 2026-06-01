@extends('layouts.app')
@section('titulo', 'Categorias')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Categorias de Produto</h2>
    @if(auth()->user()->perfil === 'admin')
    <a href="{{ route('categorias.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">+ Nova Categoria</a>
    @endif
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Nome</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Descrição</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Produtos</th>
                @if(auth()->user()->perfil === 'admin')
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($categorias as $categoria)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $categoria->nome }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $categoria->descricao ?? '—' }}</td>
                <td class="px-4 py-3 text-right text-gray-600">{{ $categoria->produtos_count }}</td>
                @if(auth()->user()->perfil === 'admin')
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('categorias.edit', $categoria) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                        <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('Excluir?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                        </form>
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">Nenhuma categoria cadastrada.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($categorias->hasPages())
    <div class="px-4 py-3 border-t">{{ $categorias->links() }}</div>
    @endif
</div>
@endsection
