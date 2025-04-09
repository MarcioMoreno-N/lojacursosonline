@extends('layout')

@section('title', 'Painel Administrativo')

@section('content')
    <div class="text-center text-light">
        <h1 class="mb-3">⚙️ Painel Administrativo</h1>
        <p class="lead">Seja bem-vindo ao painel de administração.</p>

        <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
            <a href="{{ route('admin.pedidos') }}" class="btn btn-outline-info px-4 py-2 shadow-sm">
                📦 Ver Pedidos
            </a>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-success px-4 py-2 shadow-sm">
                🎓 Gerenciar Cursos
            </a>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-outline-warning px-4 py-2 shadow-sm">
                🗂️ Categorias
            </a>
        </div>
    </div>
@endsection
