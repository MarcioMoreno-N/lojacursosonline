<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->orderBy('nome')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function adicionarAoCarrinho($id)
    {
        $produto = Produto::findOrFail($id);

        $carrinho = Session::get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
            $carrinho[$id]['subtotal'] += $produto->valor;
        } else {
            $carrinho[$id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'valor' => $produto->valor,
                'quantidade' => 1,
                'subtotal' => $produto->valor,
            ];
        }

        Session::put('carrinho', $carrinho);

        return redirect()->back()->with('success', 'Curso adicionado ao carrinho!');
    }

    public function verCarrinho()
    {
        $carrinho = Session::get('carrinho', []);
        $total = array_sum(array_column($carrinho, 'subtotal'));

        return view('carrinho.index', compact('carrinho', 'total'));
    }
}
