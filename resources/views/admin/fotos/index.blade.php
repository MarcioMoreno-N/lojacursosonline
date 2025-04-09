@extends('layout')

@section('title', 'Gerenciar Fotos')

@section('content')
    <h1 class="mb-4 text-center text-light">📸 Gerenciar Fotos - {{ $produto->nome }}</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <form action="{{ route('admin.produtos.fotos.store', $produto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" name="foto" class="form-control bg-dark text-light border-secondary" required>
                <button class="btn btn-outline-primary" type="submit">📤 Enviar Foto</button>
            </div>
        </form>
    </div>

    <div class="row">
        @forelse ($produto->fotos as $foto)
            <div class="col-md-3 mb-4">
                <div class="card bg-dark border-secondary shadow-sm">
                    <img src="{{ asset('storage/fotos/' . $foto->arquivo) }}" class="card-img-top rounded-top" alt="Foto do Produto" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <form action="{{ route('admin.produtos.fotos.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta foto?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑️ Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-light">Nenhuma foto cadastrada para este produto.</p>
        @endforelse
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-light">⬅️ Voltar para Cursos</a>
    </div>
@endsection
