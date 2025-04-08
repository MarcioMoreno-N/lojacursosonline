@extends('layout')

@section('title', 'Cursos disponíveis')

@section('content')
    <h1 class="text-center mb-4">Cursos disponíveis</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    @php
        $carrinho = session('carrinho', []);
        $quantidadeTotal = array_sum(array_column($carrinho, 'quantidade'));
    @endphp

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('carrinho.index') }}" class="btn btn-primary me-2">
            🛒 Ver Carrinho
            @if($quantidadeTotal > 0)
                <span class="badge bg-light text-dark">{{ $quantidadeTotal }}</span>
            @endif
        </a>
        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            📚 Continuar Comprando
        </a>
    </div>

    <div class="row">
        @forelse($produtos as $produto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <p class="card-text text-muted mb-2">{{ $produto->categoria->nome ?? 'Sem categoria' }}</p>
                        <p class="card-text flex-grow-1">{{ $produto->descricao }}</p>
                        <h5 class="text-primary mt-2">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h5>

                        <form method="POST" action="{{ route('carrinho.adicionar', $produto->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success mt-3 w-100">
                                Adicionar ao Carrinho
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nenhum curso disponível no momento.</p>
        @endforelse
    </div>
@endsection
