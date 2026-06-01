@extends('layouts.app')
@section('titulo', 'Cargos')

@section('conteudo')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Cargos</h2>
    <a href="{{ route('cargos.create') }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">
        + Novo Cargo
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Nome</th>
                <th class="text-left px-4 py-3 text-gray-500 font-medium">Descrição</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Salário Base</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Funcionários</th>
                <th class="text-right px-4 py-3 text-gray-500 font-medium">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($cargos as $cargo)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $cargo->nome }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $cargo->descricao ?? '—' }}</td>
                <td class="px-4 py-3 text-right text-gray-800">R$ {{ number_format($cargo->salario_base, 2, ',', '.') }}</td>
                <td class="px-4 py-3 text-right text-gray-600">{{ $cargo->funcionarios_count }}</td>
                <td class="px-4 py-3 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('cargos.edit', $cargo) }}" class="text-gray-600 hover:underline text-xs">Editar</a>
                        <form method="POST" action="{{ route('cargos.destroy', $cargo) }}" onsubmit="return confirm('Excluir este cargo?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-xs">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">Nenhum cargo cadastrado.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($cargos->hasPages())
    <div class="px-4 py-3 border-t">{{ $cargos->links() }}</div>
    @endif
</div>
@endsection
