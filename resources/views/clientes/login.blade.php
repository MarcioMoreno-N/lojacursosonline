@extends('layout')

@section('title', 'Login do Cliente')

@section('content')
    <h1 class="text-center mb-4 text-light">🔐 Login do Cliente</h1>

    <form method="POST" action="{{ route('cliente.login.submit') }}" class="card p-4 shadow bg-dark text-light" style="max-width: 500px; margin: 0 auto;">
        @csrf

        <div class="mb-3">
            <label class="form-label text-light">E-mail</label>
            <input type="email" name="email" class="form-control bg-dark text-light border-secondary" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Senha</label>
            <input type="password" name="senha" class="form-control bg-dark text-light border-secondary" required>
        </div>

        <button type="submit" class="btn btn-outline-light w-100">Entrar</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger mt-3 text-center" style="max-width: 500px; margin: 0 auto;">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
