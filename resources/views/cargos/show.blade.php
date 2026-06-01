@extends('layouts.app')
@section('titulo', 'Cargo: ' . $cargo->nome)

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('cargos.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-gray-800">{{ $cargo->nome }}</h2>
        </div>
        <a href="{{ route('cargos.edit', $cargo) }}" class="inline-flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm px-4 py-2 rounded-lg transition">
            Editar
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 mb-4">
        <dl class="grid grid-cols-2 gap-4">
            <div><dt class="text-xs text-gray-400">Nome</dt><dd class="text-sm font-medium text-gray-800">{{ $cargo->nome }}</dd></div>
            <div><dt class="text-xs text-gray-400">Salário Base</dt><dd class="text-sm font-medium text-gray-800">R$ {{ number_format($cargo->salario_base, 2, ',', '.') }}</dd></div>
            <div class="col-span-2"><dt class="text-xs text-gray-400">Descrição</dt><dd class="text-sm text-gray-600">{{ $cargo->descricao ?? '—' }}</dd></div>
        </dl>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-sm font-semibold text-gray-500 mb-3">Funcionários neste cargo ({{ $cargo->funcionarios->count() }})</h3>
        <div class="space-y-2">
            @forelse($cargo->funcionarios as $f)
            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-100">
                <span class="text-sm font-medium text-gray-800">{{ $f->usuario->name }}</span>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $f->status === 'ativo' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($f->status) }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400">Nenhum funcionário neste cargo.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
