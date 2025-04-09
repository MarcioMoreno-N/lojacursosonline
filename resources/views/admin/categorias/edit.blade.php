@extends('layout')

@section('title', 'Editar Categoria')

@section('content')
    <h1 class="text-center mb-4 text-light">✏️ Editar Categoria</h1>

    <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" class="mx-auto bg-dark p-4 rounded shadow" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label text-light">Nome da Categoria</label>
            <input type="text" name="nome" id="nome" class="form-control bg-secondary text-light border-0" value="{{ old('nome', $categoria->nome) }}" required>
            @error('nome') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="categoria_pai_id" class="form-label text-light">Categoria Pai (opcional)</label>
            <select name="categoria_pai_id" id="categoria_pai_id" class="form-select bg-secondary text-light border-0">
                <option value="">-- Nenhuma (categoria principal) --</option>
                @foreach ($categorias as $cat)
                    @if($cat->id !== $categoria->id)
                        <option value="{{ $cat->id }}" {{ old('categoria_pai_id', $categoria->categoria_pai_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nome }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('categoria_pai_id') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-outline-success me-2">💾 Atualizar</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-light">Cancelar</a>
        </div>
    </form>
@endsection
