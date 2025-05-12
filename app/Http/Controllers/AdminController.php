<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function alterarStatus($id, $status)
    {
        $validStatuses = ['pendente', 'finalizado', 'cancelado'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->route('admin.pedidos')->with('error', 'Status inválido.');
        }

        $pedido = Pedido::findOrFail($id);
        $pedido->status = $status;
        $pedido->save();

        return redirect()->route('admin.pedidos')->with('success', 'Status do pedido alterado com sucesso!');
    }

    // ✅ NOVO MÉTODO PARA GRÁFICO DE PEDIDOS POR MÊS
    public function graficoPedidos()
    {
        $dados = Pedido::select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mes"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return response()->json($dados);
    }
}
