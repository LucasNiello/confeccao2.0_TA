@extends('layouts.app')
@section('titulo', 'Dashboard')

@section('conteudo')
{{-- Cards de totais --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalFuncionariosAtivos }}</p>
            <p class="text-sm text-gray-500">Funcionários ativos</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-green-100 text-green-700 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalClientes }}</p>
            <p class="text-sm text-gray-500">Clientes cadastrados</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-yellow-100 text-yellow-700 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $pedidosEmAberto }}</p>
            <p class="text-sm text-gray-500">Pedidos em aberto</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 flex items-center gap-4">
        <div class="w-12 h-12 bg-red-100 text-red-700 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div>
            <p class="text-2xl font-bold text-gray-800">{{ $produtosEstoqueBaixo }}</p>
            <p class="text-sm text-gray-500">Estoque crítico</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Gráfico de pedidos por status --}}
    <div class="lg:col-span-1 bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-base font-semibold text-gray-800 mb-4">Pedidos por Status</h2>
        <canvas id="graficoPedidos" height="220"></canvas>
    </div>

    {{-- Últimos pedidos --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-gray-800">Últimos Pedidos</h2>
            <a href="{{ route('pedidos.index') }}" class="text-sm text-blue-600 hover:underline">Ver todos</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left pb-3 text-gray-500 font-medium">#</th>
                        <th class="text-left pb-3 text-gray-500 font-medium">Cliente</th>
                        <th class="text-left pb-3 text-gray-500 font-medium">Status</th>
                        <th class="text-right pb-3 text-gray-500 font-medium">Total</th>
                        <th class="text-right pb-3 text-gray-500 font-medium">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($ultimosPedidos as $pedido)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 text-gray-400">#{{ $pedido->id }}</td>
                        <td class="py-3 font-medium text-gray-800">{{ $pedido->cliente->nome }}</td>
                        <td class="py-3">
                            @php
                                $cor = match($pedido->status) {
                                    'pendente'    => 'yellow',
                                    'em_producao' => 'blue',
                                    'concluido'   => 'green',
                                    'cancelado'   => 'red',
                                    default       => 'gray',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-{{ $cor }}-100 text-{{ $cor }}-800">
                                {{ $pedido->statusLabel() }}
                            </span>
                        </td>
                        <td class="py-3 text-right text-gray-800">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                        <td class="py-3 text-right text-gray-400">{{ $pedido->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-400">Nenhum pedido registrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoPedidos').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pendente', 'Em Produção', 'Concluído', 'Cancelado'],
            datasets: [{
                data: [
                    {{ $pedidosPorStatus['pendente'] ?? 0 }},
                    {{ $pedidosPorStatus['em_producao'] ?? 0 }},
                    {{ $pedidosPorStatus['concluido'] ?? 0 }},
                    {{ $pedidosPorStatus['cancelado'] ?? 0 }},
                ],
                backgroundColor: ['#fef08a', '#93c5fd', '#86efac', '#fca5a5'],
                borderColor: ['#ca8a04', '#2563eb', '#16a34a', '#dc2626'],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
