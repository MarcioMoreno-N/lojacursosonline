<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class AdminPedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'itens.produto'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pedidos.index', compact('pedidos'));
    }
}
