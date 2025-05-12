@extends('layout')

@section('title', 'Meu Carrinho')

@section('content')
    <h1 class="text-center mb-4 text-light">🛒 Meu Carrinho</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
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
            <form action="{{ route('carrinho.finalizar') }}" method="POST" style="max-width: 600px; margin: 0 auto;">
                @csrf

                <div class="mb-3 text-start text-light">
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

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-outline-success">✅ Finalizar Compra</button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-outline-light">📚 Continuar comprando</a>
                </div>
            </form>

            <form action="{{ route('carrinho.esvaziar') }}" method="POST" class="mt-3" onsubmit="return confirm('Tem certeza que deseja esvaziar o carrinho?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">🗑️ Esvaziar Carrinho</button>
            </form>
        </div>
    @else
        <p class="text-center text-light">Seu carrinho está vazio.</p>
        <div class="text-center mt-4">
            <a href="{{ route('produtos.index') }}" class="btn btn-outline-light">Ver Cursos</a>
        </div>
    @endif
@endsection
