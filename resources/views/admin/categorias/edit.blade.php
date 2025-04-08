@extends('layout')

@section('title', 'Editar Categoria')

@section('content')
    <h1 class="text-center mb-4">✏️ Editar Categoria</h1>

    <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" class="mx-auto" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $categoria->nome) }}" required>
            @error('nome') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
