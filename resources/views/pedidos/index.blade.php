@extends('layout')

@section('title', 'Meus Pedidos')

@section('content')
    <h1 class="text-center mb-4">Meus Pedidos</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($pedidos->count())
        @foreach($pedidos as $pedido)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <strong>Pedido #{{ $pedido->id }}</strong>
                    <span>Status: <strong>{{ ucfirst($pedido->status) }}</strong></span>
                </div>
                <div class="card-body">
                    <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    
                    @if($pedido->endereco)
                        <p><strong>Endereço de Entrega:</strong><br>
                            {{ $pedido->endereco->descricao }} - 
                            {{ $pedido->endereco->logradouro }}, {{ $pedido->endereco->numero }} - 
                            {{ $pedido->endereco->bairro }} - 
                            {{ $pedido->endereco->cidade->nome }}/{{ $pedido->endereco->cidade->estado }}
                        </p>
                    @endif

                    <p><strong>Total:</strong> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</p>

                    <table class="table table-sm table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Valor unitário</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->itens as $item)
                                <tr>
                                    <td>{{ $item->produto->nome }}</td>
                                    <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                    <td>{{ $item->quantidade }}</td>
                                    <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">Você ainda não fez nenhum pedido.</p>
        <div class="text-center mt-4">
            <a href="{{ route('produtos.index') }}" class="btn btn-primary">Ver Cursos</a>
        </div>
    @endif
@endsection
