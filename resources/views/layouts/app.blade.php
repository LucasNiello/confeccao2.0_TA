<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Confecção TA') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="flex h-screen overflow-hidden" x-data="{ sidebarAberta: false }">

    {{-- SIDEBAR --}}
    <aside class="hidden md:flex md:flex-col md:w-64 bg-blue-900 text-white flex-shrink-0">
        {{-- Logo --}}
        <div class="flex items-center h-16 px-6 border-b border-blue-800">
            <span class="text-xl font-bold tracking-wide">Confecção TA</span>
        </div>

        {{-- Navegação --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            @if(auth()->user()->perfil === 'admin')
            <div class="pt-2 pb-1">
                <p class="px-3 text-xs font-semibold text-blue-300 uppercase tracking-wider">Administração</p>
            </div>
            <a href="{{ route('usuarios.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('usuarios.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Usuários
            </a>
            <a href="{{ route('cargos.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('cargos.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Cargos
            </a>
            <a href="{{ route('funcionarios.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('funcionarios.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Funcionários
            </a>
            @endif

            <div class="pt-2 pb-1">
                <p class="px-3 text-xs font-semibold text-blue-300 uppercase tracking-wider">Comercial</p>
            </div>
            <a href="{{ route('clientes.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('clientes.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Clientes
            </a>
            <a href="{{ route('pedidos.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('pedidos.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                Pedidos
            </a>

            <div class="pt-2 pb-1">
                <p class="px-3 text-xs font-semibold text-blue-300 uppercase tracking-wider">Estoque</p>
            </div>
            <a href="{{ route('estoque.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('estoque.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Estoque
            </a>
            <a href="{{ route('movimentacoes.create') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('movimentacoes.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                Movimentações
            </a>

            @if(auth()->user()->perfil === 'admin')
            <div class="pt-2 pb-1">
                <p class="px-3 text-xs font-semibold text-blue-300 uppercase tracking-wider">Cadastros</p>
            </div>
            <a href="{{ route('produtos.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('produtos.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Produtos
            </a>
            <a href="{{ route('categorias.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('categorias.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Categorias
            </a>
            <a href="{{ route('fornecedores.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('fornecedores.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-800' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Fornecedores
            </a>
            @endif
        </nav>

        {{-- Rodapé da sidebar --}}
        <div class="border-t border-blue-800 p-4">
            <p class="text-xs text-blue-300 truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-blue-400 capitalize">{{ auth()->user()->perfil }}</p>
        </div>
    </aside>

    {{-- CONTEÚDO PRINCIPAL --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <header class="bg-white shadow-sm z-10 flex items-center justify-between h-16 px-6">
            <h1 class="text-lg font-semibold text-gray-800">@yield('titulo', 'Dashboard')</h1>

            <div class="flex items-center gap-4">

                {{-- SININHO DE NOTIFICAÇÕES (admin only) --}}
                @if(auth()->user()->perfil === 'admin')
                @php $totalNaoLidas = auth()->user()->unreadNotifications->count(); @endphp
                <div class="relative" x-data="{ aberto: false }">
                    <button @click="aberto = !aberto"
                            class="relative p-2 text-gray-500 hover:text-blue-600 hover:bg-gray-100 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($totalNaoLidas > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            {{ $totalNaoLidas > 9 ? '9+' : $totalNaoLidas }}
                        </span>
                        @endif
                    </button>

                    <div x-show="aberto"
                         @click.outside="aberto = false"
                         x-transition
                         class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 z-50 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 border-b">
                            <h3 class="font-semibold text-gray-800 text-sm">Notificações</h3>
                            @if($totalNaoLidas > 0)
                            <form method="POST" action="{{ route('notificacoes.marcar-lidas') }}">
                                @csrf
                                <button type="submit" class="text-xs text-blue-600 hover:underline">Marcar todas como lidas</button>
                            </form>
                            @endif
                        </div>

                        <div class="max-h-72 overflow-y-auto divide-y divide-gray-50">
                            @forelse(auth()->user()->unreadNotifications->take(10) as $notificacao)
                            <a href="{{ $notificacao->data['link'] ?? route('estoque.index') }}"
                               class="block px-4 py-3 hover:bg-blue-50 transition">
                                <p class="text-sm font-medium text-gray-800">{{ $notificacao->data['mensagem'] ?? '' }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notificacao->created_at->diffForHumans() }}</p>
                            </a>
                            @empty
                            <p class="px-4 py-6 text-sm text-center text-gray-400">Nenhuma notificação não lida.</p>
                            @endforelse
                        </div>

                        <div class="border-t px-4 py-2">
                            <a href="{{ route('notificacoes.index') }}" class="text-xs text-blue-600 hover:underline">Ver todas as notificações</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Menu do usuário --}}
                <div class="relative" x-data="{ aberto: false }">
                    <button @click="aberto = !aberto"
                            class="flex items-center gap-2 text-sm text-gray-700 hover:text-blue-600 transition">
                        <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-semibold text-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden md:block max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="aberto"
                         @click.outside="aberto = false"
                         x-transition
                         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 z-50 py-1">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Meu Perfil</a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- FLASH MESSAGES --}}
        @if(session('sucesso'))
        <div x-data="{ visivel: true }" x-show="visivel" x-init="setTimeout(() => visivel = false, 4000)"
             class="mx-6 mt-4 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm">{{ session('sucesso') }}</span>
            <button @click="visivel = false" class="ml-auto text-green-500 hover:text-green-700">✕</button>
        </div>
        @endif

        @if(session('erro'))
        <div x-data="{ visivel: true }" x-show="visivel" x-init="setTimeout(() => visivel = false, 5000)"
             class="mx-6 mt-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="text-sm">{{ session('erro') }}</span>
            <button @click="visivel = false" class="ml-auto text-red-500 hover:text-red-700">✕</button>
        </div>
        @endif

        {{-- CONTEÚDO --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('conteudo')
        </main>
    </div>
</div>

</body>
</html>
