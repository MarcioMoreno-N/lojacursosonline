<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\Cidade;
use Illuminate\Support\Facades\Session;

class EnderecoController extends Controller
{
    public function index()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('cliente.login')->with('error', 'Você precisa estar logado.');
        }

        $enderecos = Endereco::where('cliente_id', Session::get('cliente_id'))
            ->with('cidade')
            ->orderBy('id', 'desc')
            ->get();

        return view('enderecos.index', compact('enderecos'));
    }

    public function create()
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('cliente.login')->with('error', 'Você precisa estar logado.');
        }

        $cidades = Cidade::orderBy('nome')->get();
        return view('enderecos.create', compact('cidades'));
    }

    public function store(Request $request)
    {
        if (!Session::has('cliente_id')) {
            return redirect()->route('cliente.login')->with('error', 'Você precisa estar logado.');
        }

        $request->validate([
            'descricao' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade_id' => 'required|exists:cidades,id',
        ]);

        Endereco::create([
            'descricao' => $request->descricao,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade_id' => $request->cidade_id,
            'cliente_id' => Session::get('cliente_id'),
        ]);

        return redirect()->route('enderecos.index')->with('success', 'Endereço cadastrado com sucesso!');
    }
}
