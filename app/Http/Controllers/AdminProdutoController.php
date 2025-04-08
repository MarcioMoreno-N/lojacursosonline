<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->orderBy('nome')->get();
        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
            'slug' => Str::slug($request->nome),
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('admin.produtos.index')->with('success', 'Curso cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        return view('admin.produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'valor' => 'required|numeric',
            'quantidade' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'quantidade' => $request->quantidade,
            'slug' => Str::slug($request->nome),
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('admin.produtos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Produto::destroy($id);
        return redirect()->route('admin.produtos.index')->with('success', 'Curso removido com sucesso!');
    }
}
