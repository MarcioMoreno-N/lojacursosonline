@extends('layout')

@section('title', 'Enviar Fotos do Curso')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">🖼️ Enviar Fotos para o Curso: <strong>{{ $produto->nome }}</strong></h1>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="mb-0">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('admin.fotos.index', $produto->id) }}" class="btn btn-outline-secondary">🔙 Voltar</a>
        </div>

        <form action="{{ route('admin.fotos.store', $produto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="fotos" class="form-label">Escolher fotos (até 5):</label>
                <input type="file" name="fotos[]" id="fotos" class="form-control" multiple
