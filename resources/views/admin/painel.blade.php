@extends('layout')

@section('title', 'Painel Administrativo')

@section('content')
    <div class="text-center">
        <h1 class="mb-3">⚙️ Painel Administrativo</h1>
        <p>Seja bem-vindo ao painel de administração.</p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('admin.pedidos') }}" class="btn btn-outline-primary">📦 Ver Pedidos</a>
            <a href="{{ route('admin.produtos.index') }}" class="btn btn-outline-success">🎓 Gerenciar Cursos</a>
        </div>
    </div>
@endsection
