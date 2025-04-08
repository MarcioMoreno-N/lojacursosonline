@extends('layout')

@section('title', 'Meu Carrinho')

@section('content')
    <h1 class="text-center mb-4">Meu Carrinho</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(count($carrinho))
        <table class="table table-bordered text-center">
            <thead>
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
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-end me-3">Total: <strong class="text-primary">R$ {{ number_format($total, 2, ',', '.') }}</strong></h4>

        <div class="text-center mt-4">
            <form action="{{ route('carrinho.finalizar') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success me-2">Finalizar Compra</button>
            </form>

            <a href="{{ route('produtos.index') }}" class="btn btn-outline-secondary me-2">Continuar comprando</a>

            <form action="{{ route('carrinho.esvaziar') }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja esvaziar o carrinho?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Esvaziar Carrinho</button>
            </form>
        </div>
    @else
        <p class="text-center">Seu carrinho está vazio.</p>
        <div class="text-center mt-4">
            <a href="{{ route('produtos.index') }}" class="btn btn-primary">Ver Cursos</a>
        </div>
    @endif
@endsection
