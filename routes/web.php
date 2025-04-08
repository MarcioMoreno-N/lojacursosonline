<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuthClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdminPedidoController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes/cadastrar', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('/cliente/login', [AuthClienteController::class, 'showLoginForm'])->name('cliente.login');
Route::post('/cliente/login', [AuthClienteController::class, 'login'])->name('cliente.login.submit');
Route::post('/cliente/logout', [AuthClienteController::class, 'logout'])->name('cliente.logout');

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

// ✅ Admin Routes
Route::get('/admin/painel', [AdminController::class, 'painel'])->name('admin.painel');
Route::get('/admin/pedidos', [AdminController::class, 'pedidos'])->name('admin.pedidos');

// Alterar status do pedido no painel admin
Route::post('/admin/pedido/{id}/status/{status}', [AdminController::class, 'alterarStatus'])->name('admin.pedidos.status');
