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

        <div class="mb-3">
            <label for="categoria_pai_id" class="form-label">Categoria Pai (opcional)</label>
            <select name="categoria_pai_id" id="categoria_pai_id" class="form-select">
                <option value="">-- Nenhuma (categoria principal) --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_pai_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
            @error('categoria_pai_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@endsection
