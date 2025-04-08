@extends('layout')

@section('title', 'Meus Endereços')

@section('content')
    <h1 class="text-center mb-4">Meus Endereços</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($enderecos->count() > 0)
        <div class="row">
            @foreach($enderecos as $endereco)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $endereco->descricao }}</h5>
                            <p class="card-text">
                                {{ $endereco->logradouro }}, {{ $endereco->numero }}<br>
                                {{ $endereco->bairro }} - {{ $endereco->cidade->nome }}/{{ $endereco->cidade->estado }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Você ainda não cadastrou nenhum endereço.</p>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('enderecos.create') }}" class="btn btn-primary">Novo Endereço</a>
    </div>
@endsection
