@extends('layouts.app')
@section('titulo', 'Clientes')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Clientes</h2>
        <p class="text-sm text-gray-500">{{ $clientes->total() }} clientes cadastrados</p>
    </div>
    <a href="{{ route('clientes.create') }}"
       class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">
        + Novo Cliente
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm">
    <div class="p-4 border-b border-gray-100">
        <form method="GET" class="flex gap-2">
            <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar por nome, CPF/CNPJ ou e-mail..."
                   class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-800">Buscar</button>
            @if($busca)
            <a href="{{ route('clientes.index') }}" class="px-4 py-2 rounded-lg text-sm border border-gray-300 hover:bg-gray-50">Limpar</a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Nome</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">CPF/CNPJ</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">E-mail</th>
                    <th class="text-left px-4 py-3 text-gray-500 font-medium">Telefone</th>
                    <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($clientes as $cliente)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $cliente->nome }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $cliente->cpf_cnpj }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $cliente->email }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $cliente->telefone }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('clientes.show', $cliente) }}" class="text-blue-600 hover:underline text-xs">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                            @if(auth()->user()->perfil === 'admin')
                            <form method="POST" action="{{ route('clientes.destroy', $cliente) }}"
                                  onsubmit="return confirm('Excluir este cliente?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-10 text-center text-gray-400">Nenhum cliente encontrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($clientes->hasPages())
    <div class="px-4 py-3 border-t border-gray-100">
        {{ $clientes->links() }}
    </div>
    @endif
</div>
@endsection
