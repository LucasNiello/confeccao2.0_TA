<?php

namespace App\Http\Controllers;

class NotificacaoController extends Controller
{
    public function index()
    {
        $notificacoes = auth()->user()->notifications()->paginate(20);

        return view('notificacoes.index', compact('notificacoes'));
    }

    public function marcarLidas()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back()->with('sucesso', 'Notificações marcadas como lidas.');
    }
}
