<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nome' => $request->nome,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
