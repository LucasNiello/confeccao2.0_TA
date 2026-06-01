@extends('layouts.app')
@section('titulo', 'Editar Categoria')

@section('conteudo')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('categorias.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h2 class="text-xl font-bold text-gray-800">Editar Categoria</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6">
        <form method="POST" action="{{ route('categorias.update', $categoria) }}" class="space-y-4">
            @csrf @method('PATCH')
            <x-input-field label="Nome da categoria" name="nome" required :value="$categoria->nome" />
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descricao', $categoria->descricao) }}</textarea>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('categorias.index') }}" class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                <x-btn-primary>Atualizar Categoria</x-btn-primary>
            </div>
        </form>
    </div>
</div>
@endsection
