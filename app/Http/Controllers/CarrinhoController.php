<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\Endereco;
use App\Models\Cliente;
use App\Models\ConfiguracaoApi;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = Session::get('carrinho', []);
        $total = array_sum(array_column($carrinho, 'subtotal'));

        $clienteId = Session::get('cliente_id');

        $enderecos = Endereco::with('cidade')
            ->where('cliente_id', $clienteId)
            ->get();

        return view('carrinho.index', compact('carrinho', 'total', 'enderecos'));
    }

    public function remover($id)
    {
        $carrinho = Session::get('carrinho', []);
        unset($carrinho[$id]);
        Session::put('carrinho', $carrinho);

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

        if (!$clienteId) {
            return redirect()->route('cliente.login')->with('error', 'Você precisa estar logado.');
        }

        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Seu carrinho está vazio.');
        }

        $request->validate([
            'endereco_id' => 'required|exists:enderecos,id'
        ]);

        $valorTotal = array_sum(array_column($carrinho, 'subtotal'));

        // 🔗 Integração com Caçapay
        $cliente = Cliente::find($clienteId);
        $cpf = $cliente->cpf;

        $config = ConfiguracaoApi::where('nome_sistema', 'cacapay')->first();
        if (!$config) {
            return redirect()->route('carrinho.index')->with('error', 'API do Caçapay não configurada.');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $config->token
            ])->post(rtrim($config->url_base, '/') . '/api/verificar-saldo', [
                'cpf' => $cpf,
                'valor' => $valorTotal
            ]);

            if ($response->failed()) {
                return redirect()->route('carrinho.index')->with('error', 'Erro ao se comunicar com a API Caçapay.');
            }

            $resultado = $response->json();
            if (!isset($resultado['aprovado']) || !$resultado['aprovado']) {
                return redirect()->route('carrinho.index')->with('error', 'Pagamento recusado pelo Caçapay.');
            }

        } catch (\Exception $e) {
            return redirect()->route('carrinho.index')->with('error', 'Erro na integração com Caçapay: ' . $e->getMessage());
        }

        // ✅ Cria o pedido
        $pedido = Pedido::create([
            'cliente_id' => $clienteId,
            'endereco_id' => $request->endereco_id,
            'valor_total' => $valorTotal,
            'status' => 'pendente',
            'status_pagamento' => 'aprovado',
        ]);

        foreach ($carrinho as $item) {
            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['valor'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        Session::forget('carrinho');

        return redirect()->route('pedidos.index')->with('success', 'Pedido realizado e pagamento aprovado!');
    }
}
