@extends('layout')

@section('title', 'Cadastrar Endereço')

@section('content')
    <h1 class="text-center mb-4 text-light">🏠 Cadastrar Novo Endereço</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <form action="{{ route('enderecos.store') }}" method="POST" class="card p-4 shadow bg-dark border-0 text-light mx-auto" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label class="form-label text-light">Descrição</label>
            <input type="text" name="descricao" class="form-control bg-secondary text-light border-0" value="{{ old('descricao') }}">
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Logradouro</label>
            <input type="text" name="logradouro" class="form-control bg-secondary text-light border-0" value="{{ old('logradouro') }}">
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Número</label>
            <input type="text" name="numero" class="form-control bg-secondary text-light border-0" value="{{ old('numero') }}">
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Bairro</label>
            <input type="text" name="bairro" class="form-control bg-secondary text-light border-0" value="{{ old('bairro') }}">
        </div>

        <div class="mb-3">
            <label class="form-label text-light">Cidade</label>
            <select name="cidade_id" class="form-select bg-secondary text-light border-0">
                <option value="">Selecione uma cidade</option>
                @foreach($cidades as $cidade)
                    <option value="{{ $cidade->id }}" {{ old('cidade_id') == $cidade->id ? 'selected' : '' }}>
                        {{ $cidade->nome }} - {{ $cidade->estado }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-outline-success w-100">Salvar Endereço</button>
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
