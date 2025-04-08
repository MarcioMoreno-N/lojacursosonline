<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProdutoController;
use App\Http\Controllers\AdminCategoriaController; // ✅ Novo Controller de Categorias

// ✅ Home redirecionando para listagem de cursos
Route::get('/', function () {
    return redirect()->route('produtos.index');
});

// ✅ Clientes
Route::get('/clientes/cadastrar', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

// ✅ Autenticação
Route::get('/cliente/login', [AuthClienteController::class, 'showLoginForm'])->name('cliente.login');
Route::post('/cliente/login', [AuthClienteController::class, 'login'])->name('cliente.login.submit');
Route::post('/cliente/logout', [AuthClienteController::class, 'logout'])->name('cliente.logout');

// ✅ Endereços
Route::get('/enderecos', [EnderecoController::class, 'index'])->name('enderecos.index');
Route::get('/enderecos/novo', [EnderecoController::class, 'create'])->name('enderecos.create');
Route::post('/enderecos', [EnderecoController::class, 'store'])->name('enderecos.store');

// ✅ Cursos (produtos)
Route::get('/cursos', [ProdutoController::class, 'index'])->name('produtos.index');

// ✅ Carrinho de compras
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/carrinho/adicionar/{id}', [ProdutoController::class, 'adicionarAoCarrinho'])->name('carrinho.adicionar');
Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::delete('/carrinho/esvaziar', [CarrinhoController::class, 'esvaziar'])->name('carrinho.esvaziar');
Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizarCompra'])->name('carrinho.finalizar');

// ✅ Pedidos do cliente
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

// ✅ Admin - Painel e Pedidos
Route::get('/admin/painel', [AdminController::class, 'painel'])->name('admin.painel');
Route::get('/admin/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');
Route::post('/admin/pedido/{id}/status/{status}', [AdminController::class, 'alterarStatus'])->name('admin.pedidos.status');

// ✅ Admin - Gerenciamento de Produtos e Categorias
Route::prefix('admin')->group(function () {
    // Produtos
    Route::get('/produtos', [AdminProdutoController::class, 'index'])->name('admin.produtos.index');
    Route::get('/produtos/novo', [AdminProdutoController::class, 'create'])->name('admin.produtos.create');
    Route::post('/produtos', [AdminProdutoController::class, 'store'])->name('admin.produtos.store');
    Route::delete('/produtos/{id}', [AdminProdutoController::class, 'destroy'])->name('admin.produtos.destroy');
    Route::get('/produtos/{id}/editar', [AdminProdutoController::class, 'edit'])->name('admin.produtos.edit');
    Route::put('/produtos/{id}', [AdminProdutoController::class, 'update'])->name('admin.produtos.update');

    // Categorias ✅
    Route::get('/categorias', [AdminCategoriaController::class, 'index'])->name('admin.categorias.index');
    Route::get('/categorias/novo', [AdminCategoriaController::class, 'create'])->name('admin.categorias.create');
    Route::post('/categorias', [AdminCategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::get('/categorias/{id}/editar', [AdminCategoriaController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/categorias/{id}', [AdminCategoriaController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/categorias/{id}', [AdminCategoriaController::class, 'destroy'])->name('admin.categorias.destroy');
});
