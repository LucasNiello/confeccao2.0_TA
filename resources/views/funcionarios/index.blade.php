@extends('layouts.app')
@section('titulo', 'Funcionários')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Funcionários</h2>
        <p class="text-sm text-gray-500">{{ $funcionarios->total() }} funcionários</p>
    </div>
    <a href="{{ route('funcionarios.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">
        + Novo Funcionário
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Nome</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Cargo</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">CPF</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Admissão</th>
                <th class="text-center px-4 py-3 text-gray-500 font-medium">Status</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($funcionarios as $funcionario)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $funcionario->usuario->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $funcionario->cargo->nome }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $funcionario->cpf }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $funcionario->data_admissao->format('d/m/Y') }}</td>
                <td class="px-4 py-3 text-center">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $funcionario->status === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($funcionario->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('funcionarios.show', $funcionario) }}" class="text-blue-600 hover:underline text-xs">Ver</a>
                        <a href="{{ route('funcionarios.edit', $funcionario) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                        <form method="POST" action="{{ route('funcionarios.destroy', $funcionario) }}" onsubmit="return confirm('Excluir este funcionário?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">Nenhum funcionário cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($funcionarios->hasPages())
    <div class="px-4 py-3 border-t">{{ $funcionarios->links() }}</div>
    @endif
</div>
@endsection
