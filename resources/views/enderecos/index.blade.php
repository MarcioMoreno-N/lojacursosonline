@extends('layout')

@section('title', 'Meus Endereços')

@section('content')
    <h1 class="text-center mb-4 text-light">🏠 Meus Endereços</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($enderecos->count() > 0)
        <div class="row">
            @foreach($enderecos as $endereco)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm bg-dark text-light border-0">
                        <div class="card-body">
                            <h5 class="card-title">{{ $endereco->descricao }}</h5>
                            <p class="card-text text-light">
                                {{ $endereco->logradouro }}, {{ $endereco->numero }}<br>
                                {{ $endereco->bairro }} - {{ $endereco->cidade->nome }}/{{ $endereco->cidade->estado }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-light">Você ainda não cadastrou nenhum endereço.</p>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('enderecos.create') }}" class="btn btn-outline-primary">➕ Novo Endereço</a>
    </div>
@endsection
