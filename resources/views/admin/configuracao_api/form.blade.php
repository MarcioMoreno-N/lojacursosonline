@extends('layout')

@section('title', 'Configurar Integração com ' . ucfirst($sistema))

@section('content')
    <div class="container">
        <h1 class="text-light text-center mb-4">🔧 Configurar Integração com <strong>{{ ucfirst($sistema) }}</strong></h1>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="mb-0">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('configuracoes_api.update', $sistema) }}" class="bg-dark p-4 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="url_base" class="form-label text-light">🔗 URL Base da API:</label>
                <input type="text" name="url_base" id="url_base" class="form-control"
                       value="{{ old('url_base', $config->url_base ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="token" class="form-label text-light">🔑 Token de Acesso (opcional):</label>
                <input type="text" name="token" id="token" class="form-control"
                       value="{{ old('token', $config->token ?? '') }}">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-outline-success">💾 Salvar Configuração</button>
            </div>
        </form>
    </div>
@endsection
