<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    // Exibe o formulário de cadastro
    public function create()
    {
        return view('clientes.create');
    }

    // Salva o cliente no banco
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|unique:clientes',
            'rg' => 'nullable',
            'data_nascimento' => 'required|date',
            'telefone' => 'required',
            'email' => 'required|email|unique:clientes',
            'senha' => 'required|min:6',
        ]);

        Cliente::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'data_nascimento' => $request->data_nascimento,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');
    }
}
