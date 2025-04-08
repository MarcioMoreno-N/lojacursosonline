<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthClienteController extends Controller
{
    public function showLoginForm()
    {
        return view('clientes.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'senha' => 'required'
    ]);

    $cliente = Cliente::where('email', $request->email)->first();

    if ($cliente && Hash::check($request->senha, $cliente->senha)) {
        Session::put('cliente_id', $cliente->id);
        Session::put('cliente_nome', $cliente->nome);
        Session::put('cliente_admin', $cliente->is_admin);


        return redirect()->route('enderecos.index')->with('success', 'Login realizado com sucesso!');
    }

    return back()->withErrors(['email' => 'Email ou senha inválidos']);
}


    public function logout(Request $request)
{
    $request->session()->flush();

    return redirect()->route('cliente.login')->with('success', 'Você saiu com sucesso.');
}

}
