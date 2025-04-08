<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('categoriaPai')->orderBy('nome')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('admin.categorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_pai_id' => 'nullable|exists:categorias,id',
        ]);

        Categoria::create([
            'nome' => $request->nome,
            'categoria_pai_id' => $request->categoria_pai_id,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categorias = Categoria::where('id', '!=', $id)->orderBy('nome')->get(); // Evita ser pai de si mesma
        return view('admin.categorias.edit', compact('categoria', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_pai_id' => 'nullable|exists:categorias,id|not_in:' . $id, // Evita loop
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nome' => $request->nome,
            'categoria_pai_id' => $request->categoria_pai_id,
        ]);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
