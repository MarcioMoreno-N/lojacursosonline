@extends('layout')

@section('title', 'Cadastrar Curso')

@section('content')
    <h1 class="text-center mb-4 text-light">➕ Cadastrar Novo Curso</h1>

    @if($errors->any())
        <div class="alert alert-danger text-light">
            <strong>Erros encontrados:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produtos.store') }}" method="POST" class="card bg-dark text-light p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Curso</label>
            <input type="text" class="form-control bg-dark text-light border-secondary" name="nome" id="nome" value="{{ old('nome') }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control bg-dark text-light border-secondary" rows="3" required>{{ old('descricao') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Preço</label>
            <input type="number" class="form-control bg-dark text-light border-secondary" name="valor" id="valor" step="0.01" value="{{ old('valor') }}" required>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade em Estoque</label>
            <input type="number" class="form-control bg-dark text-light border-secondary" name="quantidade" id="quantidade" value="{{ old('quantidade') }}" required>
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-select bg-dark text-light border-secondary" required>
                <option value="">Selecione uma categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @if(old('categoria_id') == $categoria->id) selected @endif>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Salvar Curso</button>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-secondary ms-2">Voltar</a>
        </div>
    </form>
@endsection
