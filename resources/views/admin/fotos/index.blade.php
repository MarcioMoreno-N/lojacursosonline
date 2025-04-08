@extends('layout')

@section('title', 'Gerenciar Fotos')

@section('content')
    <h1 class="mb-4 text-center">📸 Gerenciar Fotos - {{ $produto->nome }}</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <form action="{{ route('admin.produtos.fotos.store', $produto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input type="file" name="foto" class="form-control" required>
                <button class="btn btn-primary" type="submit">📤 Enviar Foto</button>
            </div>
        </form>
    </div>

    <div class="row">
        @forelse ($produto->fotos as $foto)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/fotos/' . $foto->arquivo) }}" class="card-img-top" alt="Foto do Produto">
                    <div class="card-body text-center">
                        <form action="{{ route('admin.produtos.fotos.destroy', $foto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta foto?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nenhuma foto cadastrada para este produto.</p>
        @endforelse
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary">⬅️ Voltar para Cursos</a>
    </div>
@endsection
