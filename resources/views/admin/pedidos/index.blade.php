@extends('layout')

@section('title', 'Todos os Pedidos')

@section('content')
    <h1 class="text-center mb-4 text-light">📦 Todos os Pedidos</h1>

    @if($pedidos->isEmpty())
        <p class="text-center text-light">Nenhum pedido foi realizado ainda.</p>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Cursos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente->nome }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-secondary text-light">{{ ucfirst($pedido->status) }}</span>
                            </td>
                            <td class="text-info">R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                            <td class="text-start">
                                <ul class="mb-0 ps-3">
                                    @foreach($pedido->itens as $item)
                                        <li class="text-light">{{ $item->produto->nome }} (x{{ $item->quantidade }})</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
