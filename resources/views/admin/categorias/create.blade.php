@extends('layout')

@section('title', 'Nova Categoria')

@section('content')
    <h1 class="text-center mb-4">➕ Nova Categoria</h1>

    <form action="{{ route('admin.categorias.store') }}" method="POST" class="mx-auto" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
            @error('nome') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
