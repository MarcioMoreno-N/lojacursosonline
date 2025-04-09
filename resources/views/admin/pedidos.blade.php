@extends('layout')

@section('title', 'Pedidos - Admin')

@section('content')
    <h1 class="text-center mb-4 text-light">📦 Todos os Pedidos</h1>

    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered text-center align-middle shadow">
            <thead class="table-primary text-dark">
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
                                <small class="text-light">
                                    {{ $pedido->endereco->descricao }}<br>
                                    {{ $pedido->endereco->logradouro }}, {{ $pedido->endereco->numero }}<br>
                                    {{ $pedido->endereco->bairro }}<br>
                                    {{ $pedido->endereco->cidade->nome }}/{{ $pedido->endereco->cidade->estado }}
                                </small>
                            @else
                                <span class="text-muted">Endereço não informado</span>
                            @endif
                        </td>
                        <td><span class="badge bg-info text-dark">{{ ucfirst($pedido->status) }}</span></td>
                        <td class="text-success">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                        <td class="text-light">
                            @foreach ($pedido->itens as $item)
                                {{ $item->produto->nome }} (x{{ $item->quantidade }})<br>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('admin.pedidos.status', ['id' => $pedido->id, 'status' => 'finalizado']) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm mb-1">✔️ Finalizar</button>
                            </form>
                            <form action="{{ route('admin.pedidos.status', ['id' => $pedido->id, 'status' => 'cancelado']) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">❌ Cancelar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-light">Nenhum pedido encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
