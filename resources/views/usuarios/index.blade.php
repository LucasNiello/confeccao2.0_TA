@extends('layouts.app')
@section('titulo', 'Usuários')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Usuários do Sistema</h2>
    <a href="{{ route('usuarios.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">+ Novo Usuário</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Nome</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">E-mail</th>
                <th class="text-center px-4 py-3 text-gray-500 font-medium">Perfil</th>
                <th class="text-center px-4 py-3 text-gray-500 font-medium">Status</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($usuarios as $usuario)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $usuario->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $usuario->email }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $usuario->perfil === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($usuario->perfil) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $usuario->ativo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('usuarios.edit', $usuario) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                        @if($usuario->id !== auth()->id())
                        <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" onsubmit="return confirm('Excluir este usuário?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">Nenhum usuário cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($usuarios->hasPages())
    <div class="px-4 py-3 border-t">{{ $usuarios->links() }}</div>
    @endif
</div>
@endsection
