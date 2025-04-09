@extends('layout')

@section('title', 'Meu Carrinho')

@section('content')
    <h1 class="text-center mb-4 text-light">🛒 Meu Carrinho</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(count($carrinho))
        <div class="table-responsive">
            <table class="table table-dark table-bordered text-center align-middle">
                <thead class="table-secondary text-dark">
                    <tr>
                        <th>Curso</th>
                        <th>Valor unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrinho as $item)
                        <tr>
                            <td>{{ $item['nome'] }}</td>
                            <td>R$ {{ number_format($item['valor'], 2, ',', '.') }}</td>
                            <td>{{ $item['quantidade'] }}</td>
                            <td>R$ {{ number_format($item['subtotal'], 2, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('carrinho.remover', $item['id']) }}" method="POST" onsubmit="return confirm('Remover este item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="text-end me-3 text-light">
            Total: <strong class="text-info">R$ {{ number_format($total, 2, ',', '.') }}</strong>
        </h4>

        <div class="text-center mt-4">
            <form action="{{ route('carrinho.finalizar') }}" method="POST" class="d-inline">
                @csrf

                <div class="mb-3 text-start text-light" style="max-width: 600px; margin: 0 auto;">
                    <label for="endereco_id" class="form-label">Selecione um endereço para entrega:</label>
                    <select name="endereco_id" id="endereco_id" class="form-select bg-dark text-light border-secondary" required>
                        <option value="" disabled selected>Escolha um endereço</option>
                        @foreach ($enderecos as $endereco)
                            <option value="{{ $endereco->id }}">
                                {{ $endereco->descricao }} - {{ $endereco->logradouro }}, {{ $endereco->numero }}, {{ $endereco->bairro }} ({{ $endereco->cidade->nome }}/{{ $endereco->cidade->estado }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-outline-success me-2">Finalizar Compra</button>
            </form>

            <a href="{{ route('produtos.index') }}" class="btn btn-outline-light me-2">📚 Continuar comprando</a>

            <form action="{{ route('carrinho.esvaziar') }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja esvaziar o carrinho?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Esvaziar Carrinho</button>
            </form>
        </div>
    @else
        <p class="text-center text-light">Seu carrinho está vazio.</p>
        <div class="text-center mt-4">
            <a href="{{ route('produtos.index') }}" class="btn btn-outline-light">Ver Cursos</a>
        </div>
    @endif
@endsection
