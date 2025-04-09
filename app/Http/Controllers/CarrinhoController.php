<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\Endereco;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = Session::get('carrinho', []);
        $total = array_sum(array_column($carrinho, 'subtotal'));

        $clienteId = Session::get('cliente_id');

        // Busca os endereços do cliente
        $enderecos = Endereco::with('cidade')
            ->where('cliente_id', $clienteId)
            ->get();

        return view('carrinho.index', compact('carrinho', 'total', 'enderecos'));
    }

    public function remover($id)
    {
        $carrinho = Session::get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            Session::put('carrinho', $carrinho);
        }

        return redirect()->route('carrinho.index')->with('success', 'Curso removido do carrinho!');
    }

    public function esvaziar()
    {
        Session::forget('carrinho');

        return redirect()->route('carrinho.index')->with('success', 'Carrinho esvaziado!');
    }

    public function finalizarCompra(Request $request)
    {
        $clienteId = Session::get('cliente_id');
        $carrinho = Session::get('carrinho', []);

        // Verifica se o usuário está logado
        if (!$clienteId) {
            return redirect()->route('cliente.login')->with('error', 'Você precisa estar logado.');
        }

        // Verifica se o carrinho está vazio
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        // Valida o endereço selecionado
        $request->validate([
            'endereco_id' => 'required|exists:enderecos,id'
        ]);

        // Calcula o valor total do pedido
        $valorTotal = array_sum(array_column($carrinho, 'subtotal'));

        // Cria o pedido
        $pedido = Pedido::create([
            'cliente_id' => $clienteId,
            'endereco_id' => $request->endereco_id,
            'valor_total' => $valorTotal,
            'status' => 'pendente',
        ]);

        // Cria os itens do pedido
        foreach ($carrinho as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['valor'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        // Limpa o carrinho da sessão
        Session::forget('carrinho');

        return redirect()->route('carrinho.index')->with('success', 'Pedido realizado com sucesso!');
    }
}
