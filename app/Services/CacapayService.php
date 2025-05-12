<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\ConfiguracaoApi;

class CacapayService
{
    public function autorizarPagamento(string $cpf, float $valor)
    {
        $config = ConfiguracaoApi::where('nome_sistema', 'cacapay')->first();

        if (!$config || !$config->url_base) {
            return ['success' => false, 'mensagem' => 'Configuração da API Caçapay não encontrada.'];
        }

        $url = rtrim($config->url_base, '/') . '/api/pagamento';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . ($config->token ?? '')
            ])->post($url, [
                'cpf' => $cpf,
                'valor' => $valor,
            ]);

            if ($response->successful()) {
                return [
                    'success' => $response->json('autorizado') === true,
                    'mensagem' => $response->json('mensagem') ?? '',
                    'dados' => $response->json(),
                ];
            }

            return ['success' => false, 'mensagem' => 'Erro na API Caçapay.', 'status' => $response->status()];
        } catch (\Exception $e) {
            return ['success' => false, 'mensagem' => 'Erro de conexão com a API Caçapay: ' . $e->getMessage()];
        }
    }
}
