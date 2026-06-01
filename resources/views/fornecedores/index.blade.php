@extends('layouts.app')
@section('titulo', 'Fornecedores')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Fornecedores</h2>
    @if(auth()->user()->perfil === 'admin')
    <a href="{{ route('fornecedores.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">+ Novo Fornecedor</a>
    @endif
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b border-gray-100">
        <form method="GET" class="flex gap-2">
            <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar por razão social ou CNPJ..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800">Buscar</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Razão Social</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">CNPJ</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Tipo Material</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Contato</th>
                    @if(auth()->user()->perfil === 'admin')
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($fornecedores as $fornecedor)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $fornecedor->razao_social }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $fornecedor->cnpj }}</td>
                    <td class="px-4 py-3 text-gray-600 capitalize">{{ str_replace('_', ' ', $fornecedor->tipo_material) }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $fornecedor->telefone }}</td>
                    @if(auth()->user()->perfil === 'admin')
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('fornecedores.show', $fornecedor) }}" class="text-blue-600 hover:underline text-xs">Ver</a>
                            <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                            <form method="POST" action="{{ route('fornecedores.destroy', $fornecedor) }}" onsubmit="return confirm('Excluir?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">Nenhum fornecedor cadastrado.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($fornecedores->hasPages())
    <div class="px-4 py-3 border-t">{{ $fornecedores->links() }}</div>
    @endif
</div>
@endsection
