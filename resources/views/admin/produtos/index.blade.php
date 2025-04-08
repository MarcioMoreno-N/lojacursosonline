@extends('layout')

@section('title', 'Gerenciar Cursos')

@section('content')
    <h1 class="text-center mb-4">📚 Gerenciar Cursos</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 text-end">
        <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary">➕ Adicionar Novo Curso</a>
    </div>

    @if(count($produtos))
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->categoria->nome ?? 'Sem categoria' }}</td>
                        <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>
    <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>

    <form action="{{ route('admin.produtos.destroy', $produto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este curso?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
    </form>
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">Nenhum curso cadastrado ainda.</p>
    @endif
@endsection
