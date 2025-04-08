<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function painel()
    {
        return view('admin.painel');
    }

    public function pedidos()
    {
        $pedidos = Pedido::with(['cliente', 'itens.produto'])->orderByDesc('created_at')->get();

        return view('admin.pedidos', compact('pedidos'));
    }

    // Método para alterar o status do pedido
    public function alterarStatus($id, $status)
    {
        // Verificação para garantir que o status seja válido
        $validStatuses = ['pendente', 'finalizado', 'cancelado'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->route('admin.pedidos')->with('error', 'Status inválido.');
        }

        // Encontra o pedido pelo ID
        $pedido = Pedido::findOrFail($id);

        // Altera o status do pedido
        $pedido->status = $status;
        $pedido->save(); // Salva a alteração no banco de dados

        // Redireciona de volta para a página de pedidos com mensagem de sucesso
        return redirect()->route('admin.pedidos')->with('success', 'Status do pedido alterado com sucesso!');
    }
}
