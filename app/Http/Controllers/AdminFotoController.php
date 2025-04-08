<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\FotoProduto;
use Illuminate\Support\Facades\Storage;

class AdminFotoController extends Controller
{
    public function create($produtoId)
    {
        $produto = Produto::findOrFail($produtoId);
        return view('admin.fotos.create', compact('produto'));
    }

    public function store(Request $request, $produtoId)
    {
        $produto = Produto::findOrFail($produtoId);

        $request->validate([
            'fotos.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotosExistentes = $produto->fotos()->count();

        if ($fotosExistentes >= 5) {
            return redirect()->back()->with('error', 'Este produto já possui o número máximo de 5 fotos.');
        }

        $fotos = $request->file('fotos', []);
        $quantidadeDisponivel = 5 - $fotosExistentes;

        foreach (array_slice($fotos, 0, $quantidadeDisponivel) as $foto) {
            $nomeArquivo = $foto->store('public/fotos');
            FotoProduto::create([
                'produto_id' => $produto->id,
                'arquivo' => basename($nomeArquivo),
            ]);
        }

        return redirect()->route('admin.fotos.index', $produtoId)->with('success', 'Fotos enviadas com sucesso!');
    }

    public function destroy($id)
    {
        $foto = FotoProduto::findOrFail($id);
        $produtoId = $foto->produto_id;

        Storage::delete('public/fotos/' . $foto->arquivo);
        $foto->delete();

        return redirect()->route('admin.fotos.index', $produtoId)->with('success', 'Foto removida com sucesso.');
    }
}
