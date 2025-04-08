@extends('layout')

@section('title', 'Cursos disponíveis')

@section('content')
    <h1 class="text-center mb-4">🎓 Cursos disponíveis</h1>

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
                    @php
                        $caminhoImagens = 'storage/cursos/' . $produto->id;
                        $imagens = [];

                        if (file_exists(public_path($caminhoImagens))) {
                            $arquivos = scandir(public_path($caminhoImagens));
                            foreach ($arquivos as $arquivo) {
                                if (in_array(strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'])) {
                                    $imagens[] = asset($caminhoImagens . '/' . $arquivo);
                                }
                            }
                        }
                    @endphp

                    @if(count($imagens))
                        <div id="carouselCurso{{ $produto->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($imagens as $index => $img)
                                    <div class="carousel-item @if($index === 0) active @endif">
                                        <img src="{{ $img }}" class="d-block w-100" style="height: 200px; object-fit: cover;" alt="Imagem do curso {{ $produto->nome }}">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($imagens) > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCurso{{ $produto->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselCurso{{ $produto->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Próxima</span>
                                </button>
                            @endif
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <p class="card-text text-muted mb-1">{{ $produto->categoria->nome ?? 'Sem categoria' }}</p>
                        <p class="card-text">{{ $produto->descricao }}</p>
                        <h5 class="text-primary mt-auto">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h5>

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
