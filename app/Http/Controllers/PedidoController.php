<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller
{
    public function index()
    {
        $clienteId = Session::get('cliente_id');

        $pedidos = Pedido::with(['itens.produto'])
            ->where('cliente_id', $clienteId)
            ->orderByDesc('created_at')
            ->get();

        return view('pedidos.index', compact('pedidos'));
    }
}
