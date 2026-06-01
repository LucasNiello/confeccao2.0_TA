<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estoque;
use App\Models\Funcionario;
use App\Models\Pedido;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFuncionariosAtivos = Funcionario::where('status', 'ativo')->count();
        $totalClientes           = Cliente::count();
        $pedidosEmAberto         = Pedido::whereIn('status', ['pendente', 'em_producao'])->count();
        $produtosEstoqueBaixo    = Estoque::whereColumn('quantidade', '<=', 'quantidade_minima')->count();

        $pedidosPorStatus = Pedido::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $ultimosPedidos = Pedido::with('cliente')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalFuncionariosAtivos',
            'totalClientes',
            'pedidosEmAberto',
            'produtosEstoqueBaixo',
            'pedidosPorStatus',
            'ultimosPedidos'
        ));
    }
}
