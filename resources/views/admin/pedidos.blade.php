@extends('layout')

@section('title', 'Pedidos - Admin')

@section('content')
    <h1 class="text-center mb-4">📦 Todos os Pedidos</h1>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Total</th>
                <th>Cursos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->nome }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-start">
                        @if($pedido->endereco)
                            <small>
                                {{ $pedido->endereco->descricao }}<br>
                                {{ $pedido->endereco->logradouro }}, {{ $pedido->endereco->numero }}<br>
                                {{ $pedido->endereco->bairro }}<br>
                                {{ $pedido->endereco->cidade->nome }}/{{ $pedido->endereco->cidade->estado }}
                            </small>
                        @else
                            <span class="text-muted">Endereço não informado</span>
                        @endif
                    </td>
                    <td>{{ ucfirst($pedido->status) }}</td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    <td>
                        @foreach ($pedido->itens as $item)
                            {{ $item->produto->nome }} (x{{ $item->quantidade }})<br>
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('admin.pedidos.status', ['id' => $pedido->id, 'status' => 'finalizado']) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Finalizar</button>
                        </form>

                        <form action="{{ route('admin.pedidos.status', ['id' => $pedido->id, 'status' => 'cancelado']) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">Nenhum pedido encontrado.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
