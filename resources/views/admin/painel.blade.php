@extends('layout')

@section('title', 'Painel Administrativo')

@section('content')
    <div class="text-center">
        <h1 class="mb-3">⚙️ Painel Administrativo</h1>
        <p>Seja bem-vindo ao painel de administração.</p>

        <a href="{{ route('admin.pedidos') }}" class="btn btn-outline-primary mt-4">📦 Ver Pedidos</a>
    </div>
@endsection
