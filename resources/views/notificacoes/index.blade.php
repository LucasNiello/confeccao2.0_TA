@extends('layouts.app')
@section('titulo', 'Notificações')

@section('conteudo')
<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Notificações</h2>
        @if(auth()->user()->unreadNotifications->count() > 0)
        <form method="POST" action="{{ route('notificacoes.marcar-lidas') }}">
            @csrf
            <button type="submit" class="text-sm text-blue-600 hover:underline">Marcar todas como lidas</button>
        </form>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm divide-y divide-gray-50">
        @forelse($notificacoes as $notificacao)
        <div class="p-4 flex items-start gap-3 {{ is_null($notificacao->read_at) ? 'bg-blue-50' : '' }}">
            <div class="w-2 h-2 mt-2 rounded-full flex-shrink-0 {{ is_null($notificacao->read_at) ? 'bg-blue-500' : 'bg-gray-200' }}"></div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-800">{{ $notificacao->data['mensagem'] ?? '' }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $notificacao->created_at->format('d/m/Y H:i') }} · {{ $notificacao->created_at->diffForHumans() }}</p>
                @if(isset($notificacao->data['link']))
                <a href="{{ $notificacao->data['link'] }}" class="text-xs text-blue-600 hover:underline mt-1 inline-block">Ver estoque →</a>
                @endif
            </div>
        </div>
        @empty
        <div class="p-10 text-center text-gray-400">Nenhuma notificação.</div>
        @endforelse
    </div>

    @if($notificacoes->hasPages())
    <div class="mt-4">{{ $notificacoes->links() }}</div>
    @endif
</div>
@endsection
