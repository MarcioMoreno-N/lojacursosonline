@extends('layout')

@section('title', 'Cadastro de Cliente')

@section('content')
    <h1 class="mb-4 text-center text-light">👤 Cadastro de Cliente</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST" class="card bg-dark text-light p-4 shadow border-0 mx-auto" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control bg-secondary text-light border-0" value="{{ old('nome') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control bg-secondary text-light border-0" value="{{ old('cpf') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">RG</label>
            <input type="text" name="rg" class="form-control bg-secondary text-light border-0" value="{{ old('rg') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control bg-secondary text-light border-0" value="{{ old('data_nascimento') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control bg-secondary text-light border-0" value="{{ old('telefone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control bg-secondary text-light border-0" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control bg-secondary text-light border-0">
        </div>

        <button type="submit" class="btn btn-outline-light w-100">Cadastrar</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger mt-3 text-center">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
