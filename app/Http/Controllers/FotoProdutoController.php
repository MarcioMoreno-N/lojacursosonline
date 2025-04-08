<?php

namespace App\Http\Controllers;

use App\Models\FotoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoProdutoController extends Controller
{
    public function index($produtoId)
    {
        $produto = Produto::with('fotos')->findOrFail($produtoId);
        return view('admin.fotos.index', compact('produto'));
    }

    public function store(Request $request, $produtoId)
{
    $produto = Produto::with('fotos')->findOrFail($produtoId);

    if ($produto->fotos->count() >= 5) {
        return back()->with('error', 'Este produto já possui o limite de 5 fotos.');
    }

    $request->validate([
        'foto' => 'required|image|max:2048'
    ]);

    // Nome da pasta com base no slug do curso
    $pasta = 'public/fotos/' . $produto->slug;

    // Salva a imagem na pasta correspondente
    $arquivo = $request->file('foto')->store($pasta);

    FotoProduto::create([
        'produto_id' => $produtoId,
        'arquivo' => basename($arquivo), // só o nome do arquivo
    ]);

    return back()->with('success', 'Foto adicionada com sucesso.');
}


    public function destroy($id)
    {
        $foto = FotoProduto::findOrFail($id);

        // Deleta do disco
        Storage::delete('public/fotos/' . $foto->arquivo);

        $foto->delete();

        return back()->with('success', 'Foto removida com sucesso.');
    }
}
