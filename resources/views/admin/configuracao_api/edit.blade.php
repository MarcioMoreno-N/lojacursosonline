@extends('layout')

@section('title', 'Configuração da API – Caçapay')

@section('content')
    <div class="container">
        <h1 class="text-center text-light mb-4">⚙️ Configuração da API – {{ ucfirst($config->nome_sistema) }}</h1>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('configuracoes_api.update', $config->nome_sistema) }}" method="POST" class="bg-dark p-4 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-light">URL da API:</label>
                <input type="url" name="url_base" class="form-control" value="{{ $config->url_base }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-light">Token (opcional):</label>
                <input type="text" name="token" class="form-control" value="{{ $config->token }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">💾 Salvar Configuração</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-light">⬅️ Voltar</a>
        </div>
    </div>
@endsection
