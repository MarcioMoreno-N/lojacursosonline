@extends('layout')

@section('title', 'Cadastrar Endereço')

@section('content')
    <h1 class="text-center mb-4">Cadastrar Novo Endereço</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('enderecos.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{ old('descricao') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Logradouro</label>
            <input type="text" name="logradouro" class="form-control" value="{{ old('logradouro') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Número</label>
            <input type="text" name="numero" class="form-control" value="{{ old('numero') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Bairro</label>
            <input type="text" name="bairro" class="form-control" value="{{ old('bairro') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <select name="cidade_id" class="form-select">
                <option value="">Selecione uma cidade</option>
                @foreach($cidades as $cidade)
                    <option value="{{ $cidade->id }}" {{ old('cidade_id') == $cidade->id ? 'selected' : '' }}>
                        {{ $cidade->nome }} - {{ $cidade->estado }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Salvar Endereço</button>
    </form>

    @if($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
