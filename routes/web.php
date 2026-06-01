<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MovimentacaoEstoqueController;
use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Usuários (somente admin)
    Route::resource('usuarios', UsuarioController::class);

    // Cargos (somente admin)
    Route::resource('cargos', CargoController::class);

    // Funcionários (somente admin)
    Route::resource('funcionarios', FuncionarioController::class);

    // Clientes
    Route::resource('clientes', ClienteController::class);

    // Fornecedores
    Route::resource('fornecedores', FornecedorController::class)->parameters(['fornecedores' => 'fornecedor']);

    // Categorias
    Route::resource('categorias', CategoriaController::class);

    // Produtos
    Route::resource('produtos', ProdutoController::class);

    // Estoque e movimentações
    Route::resource('estoque', EstoqueController::class)->only(['index', 'show']);
    Route::resource('movimentacoes', MovimentacaoEstoqueController::class)->only(['index', 'create', 'store']);

    // Pedidos
    Route::resource('pedidos', PedidoController::class);

    // Notificações internas
    Route::post('/notificacoes/marcar-lidas', [NotificacaoController::class, 'marcarLidas'])->name('notificacoes.marcar-lidas');
    Route::get('/notificacoes', [NotificacaoController::class, 'index'])->name('notificacoes.index');
});

require __DIR__.'/auth.php';
