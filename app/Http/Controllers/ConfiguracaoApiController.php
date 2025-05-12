<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoApi;
use Illuminate\Http\Request;

class ConfiguracaoApiController extends Controller
{
    /**
     * Exibe o formulário de edição de configuração da API.
     */
    public function edit($nome_sistema, Request $request)
{
    $sistema = $nome_sistema;

    if ($request->isMethod('post')) {
        $dados = $request->validate([
            'url_base' => 'required|string',
            'token' => 'nullable|string',
        ]);

        ConfiguracaoApi::updateOrCreate(
            ['nome_sistema' => $sistema],
            [
                'url_base' => $dados['url_base'],
                'token' => $dados['token'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Configuração salva com sucesso!');
    }

    $config = ConfiguracaoApi::where('nome_sistema', $sistema)->first();

    return view('admin.configuracao_api.form', compact('config', 'sistema'));
}


    /**
     * Atualiza ou cria a configuração da API.
     */
    public function update(Request $request, $nome_sistema)
    {
        $request->validate([
            'url_base' => 'required|url',
            'token' => 'nullable|string',
        ]);

        ConfiguracaoApi::updateOrCreate(
            ['nome_sistema' => $nome_sistema],
            [
                'url_base' => $request->url_base,
                'token' => $request->token ?? null,
            ]
        );

        return redirect()
            ->route('configuracoes_api.edit', $nome_sistema)
            ->with('success', 'Configuração atualizada com sucesso!');
    }
}
