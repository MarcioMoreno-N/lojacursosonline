@extends('layout')

@section('title', 'Categorias')

@section('content')
    <h1 class="text-center mb-4">📂 Categorias de Cursos</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">➕ Nova Categoria</a>
    </div>

    @if($categorias->count())
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td>{{ $categoria->nome }}</td>
                        <td>
                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                            <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja excluir esta categoria?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️ Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">Nenhuma categoria cadastrada.</p>
    @endif
@endsection
