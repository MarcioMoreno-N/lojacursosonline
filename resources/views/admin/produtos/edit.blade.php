@extends('layout')

@section('title', 'Editar Curso')

@section('content')
    <h1 class="text-center mb-4 text-light">✏️ Editar Curso</h1>

    @if ($errors->any())
        <div class="alert alert-danger text-light">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.produtos.update', $produto->id) }}" class="card bg-dark text-light p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Curso</label>
            <input type="text" class="form-control bg-dark text-light border-secondary" id="nome" name="nome" value="{{ old('nome', $produto->nome) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control bg-dark text-light border-secondary" id="descricao" name="descricao" rows="3" required>{{ old('descricao', $produto->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control bg-dark text-light border-secondary" id="valor" name="valor" value="{{ old('valor', $produto->valor) }}" required>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade em Estoque</label>
            <input type="number" class="form-control bg-dark text-light border-secondary" id="quantidade" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}" required>
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-select bg-dark text-light border-secondary" id="categoria_id" name="categoria_id" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == old('categoria_id', $produto->categoria_id) ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary ms-2">Cancelar</a>
        </div>
    </form>
@endsection
