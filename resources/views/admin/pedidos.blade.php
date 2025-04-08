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
                <th>Status</th>
                <th>Total</th>
                <th>Cursos</th>
                <th>Ações</th> <!-- Coluna de ações para alterar o status -->
            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->nome }}</td>
                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ ucfirst($pedido->status) }}</td>
                    <td>R$ {{ number_format($pedido->total, 2, ',', '.') }}</td>
                    <td>
                        @foreach ($pedido->itens as $item)
                            {{ $item->produto->nome }} (x{{ $item->quantidade }})<br>
                        @endforeach
                    </td>
                    <td>
                        <!-- Formulário para alterar o status do pedido -->
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
                <tr><td colspan="7">Nenhum pedido encontrado.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
